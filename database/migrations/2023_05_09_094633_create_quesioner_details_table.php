<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuesionerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quesioner_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('questioner_id')->unsigned();
            $table->string('question');
            $table->integer('scale')->nullable();
            $table->text('answer')->nullable();
            $table->foreign('questioner_id')->references('id')->on('quesioners')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('quesioner_details');
    }
}
