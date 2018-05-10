<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category');
            $table->string('title_en');
            $table->string('title_vi');
            $table->string('content_en');
            $table->string('content_vi');
            $table->string('image');
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
        Schema::drop('new');
    }
}
