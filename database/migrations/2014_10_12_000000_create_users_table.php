<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
           
             $table->string('phone')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->enum('gender',['female','male'])->nullable();
            $table->string('age');
            $table->decimal('weight');
            $table->decimal('length');
            $table->string('blood_pressure');
            $table->boolean('is_active')->defualt(1);
            $table->enum('type_diabetes',['A','B']);
            $table->enum('type_treatment',['pills','injection']);
         $table->enum('role',['admin','user'])->defualt('user');
           
            $table->char('api_token',60)->unique()->nullable();
             $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
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
