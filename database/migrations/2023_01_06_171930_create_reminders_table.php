<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bus_id');
            $table->unsignedBigInteger('issue_id');
            $table->integer('reminder_days');
            $table->integer('threeshold_days');
            $table->date('start_date');
            $table->double('distance');
            $table->double('threeshold_distance');
            $table->text('task');
            $table->unsignedBigInteger('admin_id');
            $table->boolean('active');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admins')
                ->onDelete('cascade')->onUpdate('cascade');

             $table->foreign('bus_id')->references('id')->on('buses')
                ->onDelete('cascade')->onUpdate('cascade');

             $table->foreign('issue_id')->references('id')->on('issues')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }





    public function down()
    {
        Schema::dropIfExists('reminders');
    }
}
