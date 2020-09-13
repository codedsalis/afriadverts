<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 256)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 256);
            $table->string('account_name', 200)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->string('account_number', 15)->nullable();
            $table->string('paypal_email', 200)->nullable();
            $table->string('last_dashboard', 15)->nullable();
            $table->integer('publisher_balance')->unsigned()->default(0);
            $table->integer('advertiser_balance')->unsigned()->default(0);
            $table->ipAddress('ip_address');
            $table->mediumText('browser');
            $table->string('country', 55);
            $table->string('phone_number', 20)->nullable();
            $table->text('address')->nullable();
            $table->integer('alltime_earning')->unsigned()->default(0);
            $table->timestamp('last_login')->nullable();
            $table->boolean('verified')->default(0);
            $table->boolean('approved')->default(0);
            $table->char('currency', 3)->default('NGN');
            $table->integer('referrer')->unsigned()->nullable();
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
        Schema::dropIfExists('users');
    }
}
