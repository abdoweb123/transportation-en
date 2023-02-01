<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationTrackerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('station_tracker', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('route_station_id');
            $table->unsignedBigInteger('driver_id');
            $table->enum('enter',['Y','N'])->default('N');
            $table->enum('left',['Y','N'])->default('N');
            $table->timestamps();
            $table->foreign('driver_id')->references('id')->on('drivers')
            ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('station_tracker');
    }
}
