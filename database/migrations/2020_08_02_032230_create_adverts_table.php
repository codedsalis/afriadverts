<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('ad_title');
            $table->string('ad_url');
            $table->text('ad_description');
            $table->integer('ad_cpc')->unsigned(); //In Kobo
            $table->json('ad_images');
            $table->integer('ad_budget')->unsigned(); //In kobo
            $table->integer('daily_budget')->unsigned(); //In kobo
            $table->integer('used_budget')->unsigned(); //In kobo
            $table->timestamp('start_date');
            $table->string('action_button', 30);
            $table->string('sub_text', 100);
            $table->string('advert_type', 15); //Carousel, image, responsive
            $table->string('target_keywords');
            $table->string('target_os', 50);
            $table->text('target_categories');
            $table->integer('duration')->unsigned(); //In number of days
            $table->string('advert_token', 255)->unique();
            $table->integer('ad_clicks')->unsigned();
            $table->integer('ad_impressions')->unsigned();
            $table->string('ad_status', 20); //Pending, stopped, paused, running, rejected, etc
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
        Schema::dropIfExists('adverts');
    }
}
