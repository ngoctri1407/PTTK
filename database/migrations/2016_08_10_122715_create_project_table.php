<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name_en');
            $table->string('name_vi');
            $table->string('investor');
            $table->string('address');
            $table->longText('description_en');
            $table->longText('description_vi');
            $table->longText('sell_price');
            $table->longText('lease_price');
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
        Schema::drop('project');
    }
}
