<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWantsTable extends Migration
{
    public function up()
    {
        Schema::create('wants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('shop_id');
            $table->integer('order');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('shop_id')->references('id')->on('shop_items')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('wants');
    }
}
