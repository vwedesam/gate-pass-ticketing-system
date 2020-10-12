<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TicketSetupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('ticket_setup', function(Blueprint $table){
            $table->increments('id');
            $table->integer('ticket_id')->unsigned();
            $table->string('setup_type');
            $table->integer('cost');
            $table->timestamps();

            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('restrict');

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
