<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeOfRoleCollumnInTeamInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('team_invitations', function (Blueprint $table) {
            $table->dropColumn('role');
        });

        Schema::table('team_invitations', function (Blueprint $table) {
            $table->after('email', function ($table) {
                $table->enum('role', ['admin', 'user'])->default('user');
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
        Schema::table('team_invitations', function (Blueprint $table) {
            $table->dropColumn('role');
        });

        Schema::table('team_invitations', function (Blueprint $table) {
            $table->after('email', function ($table) {
                $table->string('role');
            });
        });
    }
}
