<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentHotelRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_hotel_room', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->nullable()->constrained();
            $table->foreignId('room_id')->nullable()->constrained();
            $table->morphs('equipment');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('equipment_hotel_room');
    }
}
