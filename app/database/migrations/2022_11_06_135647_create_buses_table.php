<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->integer('status')->default(0);
            $table->unsignedBigInteger('busType_id');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admins')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('busType_id')->references('id')->on('bus_types')
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
        Schema::dropIfExists('buses');
    }
}
