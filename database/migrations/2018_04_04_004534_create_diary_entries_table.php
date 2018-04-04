<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiaryEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diary_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('situation', 400);
            $table->string('emotion', 50);
            $table->integer('emotion_intensity')->unsigned()->comment('From 0 to 100');
            $table->string('automatic_thought', 400);
            $table->string('type', 50)->comment('Unhelpful thinking type');
            $table->string('realistic_thought', 400);
            $table->string('outcome', 50);
            $table->integer('outcome_intensity')->unsigned()->comment('From 0 to 100');
            $table->string('future_learning', 400)->nullable();
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('diary_entries');
    }
}
