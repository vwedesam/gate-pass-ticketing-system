<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IssuedTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('issued_ticket', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('ticket_num');
            $table->integer('ticket_id')->unsigned();
            $table->string('ticket_type');
            $table->integer('no_of_adult')->default(0);;
            $table->integer('no_of_children')->default(0);;
            $table->integer('total');
            $table->integer('issued_by')->unsigned();
            $table->timestamps();

            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('restrict');
            $table->foreign('issued_by')->references('id')->on('users')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
