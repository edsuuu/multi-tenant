<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tenants', static function (Blueprint $table) {
            $table->string('id')->primary();

            $table->string('name', 60)->nullable();
            $table->string('documents', 18)->unique()->nullable();
            $table->string('zip_code', 9)->nullable();
            $table->string('address', 60)->nullable();
            $table->string('city')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('number', 10)->nullable();
            $table->string('uf', 2)->nullable();
            $table->string('photo')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignUuid('tenant_id')->after('remember_token')->nullable()->constrained('tenants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
}
