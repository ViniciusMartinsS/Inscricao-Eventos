<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('description');
            $table->dateTime('beginning_datetime');
            $table->dateTime('end_datetime');
            $table->Integer('minimum_quorum')->nullable();
            $table->Integer('maximum_capacity');
            $table->string('place');
            $table->Integer('event_id')->unsigned();
            $table->timestamps();
            //Criar tabela de resolução do Bond 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
