<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalCollumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->after('name', function ($table) {
                $table->renameColumn('name', 'firstname');
                $table->string('lastname');
                $table->string('street');
                $table->foreignId('city_id')->constrained();
                $table->foreignId('team_id')->nullable()->constrained();
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
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('firstname', 'name');
            $table->dropColumn('lastname', 'street', 'city_id', 'team_id');
        });
    }
}
