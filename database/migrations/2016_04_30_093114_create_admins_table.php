<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->string('email', 120)->unique();
            $table->string('password', 120);
            $table->string('role', 30)->default('admin');
            $table->rememberToken();  // Adds remember_token as VARCHAR(100) NULL
            $table->timestamps();     // Adds created_at and updated_at columns
            $table->timestamp('last_login')->nullable();
        });

        Schema::create('admin_password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admins');
        Schema::drop('admin_password_resets');
    }
}
