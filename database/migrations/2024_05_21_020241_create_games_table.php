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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journey_id')->constrained()->onDelete('cascade');
            $table->foreignId('team_a_id')->constrained('teams')->onDelete('cascade');
            $table->integer('goals_a');
            $table->foreignId('team_b_id')->constrained('teams')->onDelete('cascade');
            $table->integer('goals_b');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
