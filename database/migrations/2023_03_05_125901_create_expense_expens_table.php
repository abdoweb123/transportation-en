<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseExpensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_expens', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->double('solar_g')->nullable();
            $table->date('date')->nullable();
            $table->unsignedBigInteger('bus_id')->default(0);
            $table->double('solar_g_liter')->nullable();
            $table->double('km')->nullable();
            $table->double('solar_esthlak')->nullable();
            $table->double('zeyout')->nullable();
            $table->double('solar_liter')->nullable();
            $table->double('kawetch')->nullable();
            $table->double('btarya')->nullable();
            $table->double('zogag')->nullable();
            $table->double('ghasel_tashhim')->nullable();
            $table->double('maintance_flater')->nullable();
            $table->double('eslah_kt_ghear')->nullable();
            $table->double('grash_edafy')->nullable();
            $table->double('ather')->nullable();
            $table->double('total')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('expense_expens');
    }
}
