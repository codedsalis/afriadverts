<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websites', function (Blueprint $table) {
            $table->id();
            $table->foreign('user_id');
            $table->string('url', 255);
            $table->string('category', 64);
            $table->string('pub_key', 45);
            $table->boolean('verified');
            $table->boolean('approved');
            $table->string('reason_unapproved');
            $table->integer('page_views');
            $table->integer('earning');
            $table->integer('ctr');
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
        Schema::dropIfExists('websites');
    }
}
