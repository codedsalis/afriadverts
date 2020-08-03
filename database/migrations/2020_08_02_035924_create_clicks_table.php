<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clicks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users'); //The publisher ID
            $table->integer('advert_id')->unsigned();
            $table->foreign('advert_id')->references('id')->on('adverts'); //The advert id
            $table->integer('advertiser_id')->unsigned();
            $table->foreign('advertiser_id')->references('id')->on('users'); //The advertiser id
            $table->integer('unit_id')->unsigned();
            $table->ipAddress('ip_address');
            $table->string('browser');
            $table->string('os');
            $table->string('web_url'); //The page from where the advert was clicked
            $table->boolean('validity');
            $table->integer('earning')->unsigned(); //In Kobo
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
        Schema::dropIfExists('clicks');
    }
}
