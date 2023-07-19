<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('name')->nullable();
            $table->string('profile')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('country_code')->nullable();
            $table->string('contact')->nullable();
            $table->text('address')->nullable();
            $table->string('password')->nullable();
            $table->enum('role', [1, 2, 3])->comment('[1 => Super admin, 2 => School admin, 3 => Student]');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'superadmin@uniweb.com',
            'password' => bcrypt('password'),
            'role' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
