<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

        /*
        Schema::create('category_video', function (Blueprint $table)
        {
            $table->integer('video_id')->unsigned()->index();
            $table->foreign('video_id')
                  ->references('id')
                  ->on('videos')
                  ->onDelete('cascade');

            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');


            $table->timestamps();
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories');
        //Schema::drop('category_video');
    }
}
