<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->Increments('id');

            $table->integer('event_type_id')->nullable()->unsigned();
            $table->foreign('event_type_id')->references('id')->on('event_types');

            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('hall_id')->nullable()->unsigned();
            $table->foreign('hall_id')->references('id')->on('halls');

            $table->dateTime('date_time_event');
            $table->integer('count_peoples');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
