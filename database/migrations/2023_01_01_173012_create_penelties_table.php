<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeneltiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penelties', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->unsignedBigInteger('penelty_type_id'); 
            $table->unsignedBigInteger('driver_id');
            $table->string('date');
            $table->double('amount');
            $table->double('driver_pay');
            $table->double('company_pay');
            $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('penelties');
    }
}
