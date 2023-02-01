<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('booking_request_id')->default(0);
            $table->integer('rate')->default(0);
            $table->string('comment')->nullable();
            $table->timestamps();
            $table->foreign('driver_id')->references('id')->on('drivers')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('employee_id')->references('id')->on('my_employees')
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
        Schema::dropIfExists('reviews');
    }
}
