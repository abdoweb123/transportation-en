<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_trackers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bus_id');
            $table->unsignedBigInteger('driver_id');
            $table->double('lat');
            $table->double('long');
            $table->timestamps();
            $table->foreign('bus_id')->references('id')->on('buses')
            ->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('location_trackers');
    }
}
