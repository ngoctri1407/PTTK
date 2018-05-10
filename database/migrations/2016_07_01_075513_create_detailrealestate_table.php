<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailrealestateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_realestate', function (Blueprint $table) {
            $table->increments('id_key');
            $table->integer('id');
            $table->integer('type');
            $table->string('title_en');
            $table->string('title_vi');
            $table->string('description_en');
            $table->string('description_vi');
            $table->float('price');
            $table->integer('type_price');
            $table->string('address');
            $table->float('area');
            $table->integer('bathroom');
            $table->integer('bedroom');
            $table->string('township');
            $table->date('available_time');
            $table->integer('status');
            $table->integer('id_author');
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
        Schema::drop('detail_realestate');
    }
}
