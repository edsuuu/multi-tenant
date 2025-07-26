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

    public static function login($userId, $domain, $remember = false)
    {
        if ($domain === null) {
            $user = User::find($userId);
            Auth::login($user, $remember);
            return redirect()->route('dashboard');
        }

        return (new self())->redirectTenant($userId, $domain);
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
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->user();

            $userDB = User::query()
                ->with(['tenant.domain'])
                ->where('email', $googleUser->user['email'])
                ->orWhere('google_id', $googleUser->user['id'])
                ->first();

            if (!$userDB) {
                return redirect()->route('login')->withErrors(['google' => 'Erro ao autenticar com Google. Não existe conta com esse email vinculado.']);
            }

            if (!isset($userDB->google_id)) {
                $userDB->update([
                    'google_id' => $googleUser->user['id'],
                    'email_verified_at' => now(),
                ]);
            }

            if ($userDB->tenant === null) {
                Auth::login($userDB, true);
                // validar como vai funcionar o gerenciamento dos tentant
                return redirect()->route('dashboard');
            }

            $token = encrypt(['user_id' => $userDB->id, 'expires' => now()->addMinutes(4), 'remember' => true]);

            return redirect()->route('googleRedirectAuth', ['token' => $token]);
        } catch (ClientException $e) {
            Log::channel('daily')->error($e);
            return redirect()->route('login')->withErrors(['google' => 'Erro ao autenticar com Google. Por favor, tente novamente.']);
        } catch (\Exception $e) {
            Log::channel('daily')->error($e);
            return redirect()->route('login')->withErrors(['error' => 'Ocorreu um erro inesperado. Tente novamente.']);
        }
    }

    public function redirectAuthTenant($token)
    {
        $data = decrypt($token);

        if (now()->gt($data['expires'])) {
            session()->flash('error', 'Erro ao tentar autenticar');
            return redirect()->route('login');
        }

        $userDB = User::query()
            ->with(['tenant.domain'])
            ->where('id', $data['user_id'])
            ->first();

        return $this->redirectTenant($userDB->id,$userDB->tenant->domain->domain);
    }

    private function redirectTenant($userId, $domain)
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
