<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwapRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swap_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->default(0);
            $table->unsignedBigInteger('booking_request_id')->default(0);
            $table->string('from');
            $table->string('to');
            $table->date('date');
            $table->time('time');
            $table->string('comment')->nullable();
            $table->enum('is_done',['Y','N'])->default('N');
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
        Schema::dropIfExists('swap_requests');
    }
}
