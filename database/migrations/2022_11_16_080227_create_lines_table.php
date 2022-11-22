<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tripData_id');
            $table->unsignedBigInteger('stationFrom_id');
            $table->unsignedBigInteger('stationTo_id');
            $table->unsignedBigInteger('degree_id')->nullable();
            $table->unsignedBigInteger('admin_id');
            $table->boolean('active')->default(1);
            $table->double('priceGo')->nullable();        // سعر الذهاب
            $table->double('priceBack')->nullable();     // سعر الذهاب والعودة
            $table->double('priceForeignerGo')->nullable();     // سعر الذهاب للأجانب
            $table->double('priceForeignerBack')->nullable();     // سعر الذهاب والعودة للأجانب
            $table->double('cancelFee')->nullable();   // غرامة إالغاء الرحلة
            $table->double('editFee')->nullable();     // غرامة تعديل الرحلة
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('admin_id')->references('id')->on('admins')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('stationFrom_id')->references('id')->on('trip_stations')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('stationTo_id')->references('id')->on('trip_stations')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('tripData_id')->references('id')->on('trip_data')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('degree_id')->references('id')->on('degrees')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }




    public function down()
    {
        Schema::dropIfExists('lines');
    }
}
