<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_fees', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->unsignedBigInteger('type_id'); 
            $table->double('amount'); 
            $table->unsignedBigInteger('driver_id')->default(0); 
            $table->unsignedBigInteger('bus_id')->default(0); 
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
        Schema::dropIfExists('extra_fees');
    }
}
