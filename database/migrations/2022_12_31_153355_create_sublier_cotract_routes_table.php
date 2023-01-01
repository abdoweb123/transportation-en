<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSublierCotractRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sublier_cotract_routes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contracts_id'); 
            $table->unsignedBigInteger('suplier_id'); 
            $table->unsignedBigInteger('rote_id'); 
            $table->unsignedBigInteger('bus_type_id'); 
            $table->unsignedBigInteger('service_type_id'); 
            $table->double('service_value');
            $table->integer('operations_number');
            $table->timestamps();
            $table->foreign('contracts_id')->references('id')->on('contract_clients')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('rote_id')->references('id')->on('routes')
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
        Schema::dropIfExists('sublier_cotract_routes');
    }
}
