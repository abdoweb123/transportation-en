<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReminderHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminder_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reminder_id');
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->double('total_paid')->default(0);
            $table->double('cost_per_day')->default(0);
            $table->boolean('done')->default(false);
            $table->unsignedBigInteger('admin_id');
            $table->boolean('active');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admins')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('reminder_id')->references('id')->on('reminders')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('vendor_id')->references('id')->on('vendors')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }




    public function down()
    {
        Schema::dropIfExists('reminder_histories');
    }
}
