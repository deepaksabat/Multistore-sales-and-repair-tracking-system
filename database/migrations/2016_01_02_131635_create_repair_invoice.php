<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id');
            $table->integer('user_id');
            $table->string('invoice_id');
            $table->decimal('total_price', 12);
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('customer_address');
            $table->enum('status', ['waiting', 'in_process', 'completed']);
            $table->string('special_note');
            $table->timestamp('delivery_date');
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
        Schema::drop('repair_invoices');
    }
}
