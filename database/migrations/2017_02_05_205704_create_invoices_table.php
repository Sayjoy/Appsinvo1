<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create ('invoices', function(Blueprint $table){
           $table->increments('id');
            $table->string('invoice_id')->unique();
            $table->string('title');
            $table->string('po');
            $table->integer('amount');
            $table->smallInteger('paid');
            $table->integer('created_by');
            $table->integer('client_id');
            $table->integer('vat');
            $table->integer('discount');
            $table->integer('d_type');
            $table->date('due_date');
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
        Schema::drop ('invoices');
    }
}
