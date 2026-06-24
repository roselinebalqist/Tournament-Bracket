<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tournament_participants', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tournament_id')
                ->constrained('tournaments')
                ->cascadeOnDelete();

            $table->foreignId('team_id')
                ->constrained('teams')
                ->cascadeOnDelete();

            $table->foreignId('registered_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending');

            $table->unsignedSmallInteger('seed_number')->nullable();

            $table->dateTime('approved_at')->nullable();
            $table->dateTime('rejected_at')->nullable();

            $table->timestamps();

            $table->unique(['tournament_id', 'team_id']);
            $table->index(['tournament_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tournament_participants');
    }
};
