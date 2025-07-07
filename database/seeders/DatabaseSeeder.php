<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Stancl\Tenancy\Database\Models\Domain;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

//        $tenant = Tenant::create([
//            'id' => str()->uuid()
//        ]);

//        Domain::create([
//            'tenant_id' => $tenant->id,
//            'domain' => 'edsu.localhost'
//        ]);

//        User::factory()->create([
//            'tenant_id' => $tenant->id,
//            'name' => 'Edsu MultiTenant',
//            'email' => 'edsu@multitenant.com',
//            'email_verified_at' => now(),
//            'password' => bcrypt('123456'),
//        ]);

        $this->call([
//            CreateSegment::class,
//            PlanSeeder::class,
        ]);
    }
}
