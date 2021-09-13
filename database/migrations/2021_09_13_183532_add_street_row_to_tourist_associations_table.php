<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStreetRowToTouristAssociationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tourist_associations', function (Blueprint $table) {
            $table->after('team_id', function ($table) {
                $table->string('street')->default('null');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tourist_associations', function (Blueprint $table) {
            $table->dropColumn('street');
        });
    }
}
