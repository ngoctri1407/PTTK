<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealestateAmenities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realestate_amenities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_detail_realestate');
            $table->integer('id_amenities');
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
        Schema::drop('realestate_amenities');
    }
}
