<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_trackers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_run_trip_bus_id')->default(0);
            $table->unsignedBigInteger('bus_id')->default(0);
            $table->unsignedBigInteger('employee_id')->default(0);
            $table->enum('enter',['Y','N'])->default('N');
            $table->enum('leave',['Y','N'])->default('N');
            $table->enum('not_found',['Y','N'])->default('N');
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
        Schema::dropIfExists('client_trackers');
    }
}
