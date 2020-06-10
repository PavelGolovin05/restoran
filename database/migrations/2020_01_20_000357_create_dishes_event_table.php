<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes_event', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('event_id')->nullable()->unsigned();
            $table->integer('dish_id')->nullable()->unsigned();
            $table->integer('count');

            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('dish_id')->references('id')->on('dishes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishes_event');
    }
}
