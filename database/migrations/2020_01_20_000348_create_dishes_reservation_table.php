<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes_reservation', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('reservation_id')->nullable()->unsigned();
            $table->integer('dish_id')->nullable()->unsigned();
            $table->integer('count');

            $table->foreign('dish_id')->references('id')->on('dishes');
            $table->foreign('reservation_id')->references('id')->on('reservations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishes_reservation');
    }
}
