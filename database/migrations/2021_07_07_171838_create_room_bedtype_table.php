<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomBedtypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_bedtype', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained();
            $table->foreignId('bedtype_id')->constrained();
            $table->smallInteger('count');
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
        Schema::dropIfExists('room_bedtype');
    }
}
