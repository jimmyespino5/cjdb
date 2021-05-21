<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeamIdAAndTeamIdBToResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('results', function (Blueprint $table) {
            $table->unsignedInteger('team_id_a')->after('horary');
            $table->unsignedInteger('team_id_b')->after('scorers_a');
            $table->foreign('team_id_a')->references('id')->on('teams')->onDelete('CASCADE');
            $table->foreign('team_id_b')->references('id')->on('teams')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('results', function (Blueprint $table) {
            $table->dropForeign(['team_id_a']);
            $table->dropForeign(['team_id_b']);
        });
    }
}
