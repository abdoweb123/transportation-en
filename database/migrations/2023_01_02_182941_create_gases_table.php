<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id'); 
            $table->unsignedBigInteger('bus_id'); 
            $table->unsignedBigInteger('bus_type_id'); 
            $table->unsignedBigInteger('route_id'); 
            $table->double('kilometer');
            $table->double('gas_amount');
            $table->double('paid_amount');
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
        Schema::dropIfExists('gases');
    }
}
