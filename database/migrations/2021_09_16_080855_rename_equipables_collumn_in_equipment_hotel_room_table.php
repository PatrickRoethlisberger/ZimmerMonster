<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameEquipablesCollumnInEquipmentHotelRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipment_hotel_room', function (Blueprint $table) {
            $table->renameColumn('equipable_id', 'equipables_id');
            $table->renameColumn('equipable_type', 'equipables_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipment_hotel_room', function (Blueprint $table) {
            $table->renameColumn('equipables_id', 'equipable_id');
            $table->renameColumn('equipables_type', 'equipable_type');
        });
    }
}
