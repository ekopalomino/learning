<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingScoreTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_score_temps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('training_id');
            $table->string('employee_nik');
            $table->decimal('pre_score');
            $table->decimal('post_score');
            $table->bigInteger('status_id');
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
        Schema::dropIfExists('training_score_temps');
    }
}
