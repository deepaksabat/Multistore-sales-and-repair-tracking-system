<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('slug');
            $table->string('email');
            $table->text('description');
            $table->text('address');
            $table->text('bank_details');
            $table->string('logo');
            $table->enum('status', [0,1,2,3,4]);
            $table->enum('plan', ['monthly', 'yearly']);
            $table->enum('commission_type', ['fixed', 'percent']);
            $table->string('commission_amount');
            $table->enum('payment_method', ['bank_transfer', 'store_credit', 'both']);
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('subscription_ends_at')->nullable();
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
        Schema::drop('shops');
    }
}
