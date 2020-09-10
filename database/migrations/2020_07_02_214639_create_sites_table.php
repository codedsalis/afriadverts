<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('url', 255);
            $table->string('category', 64);
            $table->string('pub_key', 45);
            $table->boolean('verified')->default(0)->nullable();
            $table->boolean('approved')->default(0)->nullable();
            $table->string('reason_unapproved')->nullable();
            $table->integer('page_views')->unsigned()->default(0);
            $table->integer('earning')->unsigned()->default(0);
            $table->integer('ctr')->unsigned()->default(0);
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
        Schema::dropIfExists('sites');
    }
}
