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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('user_level')->default(0)->comment('0: Community, 1: Psychologist, 2: Admin');
            $table->boolean('active')->default(true);

            $table->date('birth_date')->nullable();
            $table->tinyInteger('gender')->comment('0: Male, 1: Female')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('occupation')->nullable();
            $table->tinyInteger('education_level')->comment('0: Primary, 1: Secondary, 2: Tertiary')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
