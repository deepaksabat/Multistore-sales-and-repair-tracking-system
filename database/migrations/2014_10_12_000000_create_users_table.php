<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('user_name')->nullable();
            $table->string('email')->unique();
            $table->string('password', 60);

            $table->integer('country_id');
            $table->string('mobile');
            $table->string('address');
            $table->string('website');
            $table->string('phone');
            $table->string('photo');

            $table->enum('user_type', ['user', 'super_admin', 'sub_admin','shop_admin']);
            //active_status 0:pending, 1:active, 2:block;
            $table->enum('active_status', [0,1,2]);
            //is_email_verified 0:unverified, 1:verified
            $table->enum('is_email_verified', [0,1]);
            $table->string('activation_code');
            //is_online => 0:offline, 1:online;
            $table->enum('is_online', [0,1]);
            $table->integer('shop_id');
            $table->string('referral_id', 20);
            $table->integer('referred_by');
            $table->timestamp('last_login')->nullable();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
