<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutfitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outfits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 50);
            $table->string('color', 20);
            $table->integer('size');
            $table->text('about');
            $table->unsignedBigInteger('master_id');
            $table->foreign('master_id')->references('id')->on('masters');
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
        Schema::dropIfExists('outfits');
    }
}
