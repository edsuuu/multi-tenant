<?php

namespace App\Http\Controllers;

use App\Livewire\Actions\Logout;
use App\Models\User;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class AuthProvidersController extends Controller
{
    public function googleAuth()
    {
        return Socialite::driver('google')->redirect();
    }

    public function authTenant($token): ?\Illuminate\Http\RedirectResponse
    {
        try {
            $data = decrypt($token);

            if (now()->gt($data['expires'])) {
                session()->flash('error', 'Erro ao tentar autenticar');
                return redirect()->route('login');
            }

            $user = User::findOrFail($data['user_id']);
            Auth::login($user, $data['remember']);

            return redirect()->route('dashboard');
        } catch (DecryptException $e) {
            Log::error($e);
            return redirect()->route('home');
        }
    }

    public function googleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::query()
                ->with(['tenant.domain'])
                ->where('email', $googleUser->user['email'])
                ->first();

            if (!$user) {
                return redirect()->route('login')->withErrors(['google' => 'Erro ao autenticar com Google. Não existe conta com esse email vinculado.']);
            }

            if (!isset($user->google_id)) {
                $user->update([
                    'google_id' => $googleUser->user['id'],
                    'email_verified_at' => now(),
                ]);
            }

            if (!$user->tenant) {
                Auth::login($user, true);
                // validar como vai funcionar o gerenciamento dos tentant
                return redirect()->route('dashboard');
            }

            return self::redirectTenant($user->id, $user->tenant->domain);
        } catch (ClientException $e) {
            \Log::error($e);
            return redirect()->route('login')->withErrors(['google' => 'Erro ao autenticar com Google. Por favor, tente novamente.']);
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->route('login')->withErrors(['error' => 'Ocorreu um erro inesperado. Tente novamente.']);
        }
    }

    public static function redirectTenant($userId, $domain)
    {
        $baseDomain = config('app.base_domain');
        $token = encrypt(['user_id' => $userId, 'expires' => now()->addMinutes(), 'remember' => true]);
        return redirect(tenant_route("{$domain}.{$baseDomain}", 'auth-redirect', ['token' => $token]));
    }

    public function logout(Logout $logout)
    {
        $logout();
        return redirect('dashboard');
    }
}
