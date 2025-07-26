<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Stancl\Tenancy\Database\Models\Domain;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder_001::class,
//            PlanSeeder::class,
        ]);

        $faker = Faker::create('pt_BR');

        $userTenant = User::query()->updateOrCreate([
            'email' => 'tenant@tenant.com',
        ], [
            'name' => $faker->name,
            'email' => 'tenant@tenant.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'cellphone' => $faker->phoneNumber,
        ]);

        User::query()->updateOrCreate([
            'email' => 'admin@admincentral.com',
        ], [
            'name' => $faker->name,
            'email' => 'admin@admincentral.com',
            'google_id' => config('app.google_id'),
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'cellphone' => $faker->phoneNumber,
        ]);

        $slug = Str::slug($faker->company);

        $tenant = Tenant::query()->create([
            'id' => str()->uuid(),
            'name' => $slug,
            'main_user_id' => $userTenant->id,
            'documents' => $faker->cnpj
        ]);

        $userTenant->update(['tenant_id' => $tenant->id]);

        Domain::query()->create([
            'domain' => str_replace(' ', '-',$slug),
            'tenant_id' => $tenant->id,
        ]);
    }
}
