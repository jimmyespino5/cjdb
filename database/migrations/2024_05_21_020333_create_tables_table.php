<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            $table->integer('jj');
            $table->integer('jg');
            $table->integer('je');
            $table->integer('jp');
            $table->integer('gf');
            $table->integer('gc');
            $table->integer('avg');
            $table->integer('pts');
            $table->foreignId('tournament_id')->constrained()->onDelete('cascade');
            $table->integer('group');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
