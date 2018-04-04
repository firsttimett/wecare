<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScreeningTestTakensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screening_test_takens', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('anxiety_score')->unsigned()->default(0);
            $table->smallInteger('depression_score')->unsigned()->default(0);
            $table->smallInteger('stress_score')->unsigned()->default(0);
            $table->string('question_choice_answer')->comment('The questions ID, choices ID & User`s answers');
            $table->integer('user_id')->unsigned();
            $table->integer('screening_test_id')->unsigned();
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
        Schema::dropIfExists('screening_test_takens');
    }
}
