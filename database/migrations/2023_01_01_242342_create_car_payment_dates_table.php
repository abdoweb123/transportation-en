<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarPaymentDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_payment_dates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_payment_id'); 
            $table->string('date');
            $table->double('amount');
            $table->double('paid');
            $table->timestamps();
            $table->foreign('car_payment_id')->references('id')->on('car_payments')
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
        Schema::dropIfExists('car_payment_dates');
    }
}
