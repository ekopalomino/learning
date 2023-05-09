<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('training_id')->unsigned();
            $table->string('employee_nik');
            $table->string('employee_name');
            $table->decimal('pre_score,50,2')->nullable();
            $table->decimal('post_score,50,2')->nullable();
            $table->string('status_id');
            $table->foreign('training_id')->references('id')->on('trainings')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('training_people');
    }
}
