<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_discounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_client_id');
            $table->unsignedBigInteger('company_contract_id');
            $table->unsignedBigInteger('discount_id');
            $table->double('discount_value')->default(0);
            $table->timestamps();
            $table->foreign('contract_client_id')->references('id')->on('contract_clients')
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
        Schema::dropIfExists('contract_discounts');
    }
}
