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
        Schema::create('arbitrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journey_id')->constrained();
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            $table->string('solvent');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arbitrations');
    }
};
