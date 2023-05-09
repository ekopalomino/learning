<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_hours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('training_id')->unsigned();
            $table->string('training_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->uuid('status');
            $table->integer('participants')->nullable();
            $table->decimal('avg_score',50,2)->nullable();
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
        Schema::dropIfExists('training_hours');
    }
}
