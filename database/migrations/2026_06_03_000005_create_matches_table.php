<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tournament_id')
                ->constrained('tournaments')
                ->cascadeOnDelete();

            $table->unsignedSmallInteger('round');
            $table->unsignedSmallInteger('match_number');

            $table->foreignId('team_one_id')
                ->nullable()
                ->constrained('tournament_participants')
                ->nullOnDelete();

            $table->foreignId('team_two_id')
                ->nullable()
                ->constrained('tournament_participants')
                ->nullOnDelete();

            $table->unsignedSmallInteger('team_one_score')
                ->nullable();

            $table->unsignedSmallInteger('team_two_score')
                ->nullable();

            $table->foreignId('winner_id')
                ->nullable()
                ->constrained('tournament_participants')
                ->nullOnDelete();

            $table->foreignId('next_match_id')
                ->nullable()
                ->constrained('matches')
                ->nullOnDelete();

            $table->enum('next_match_slot', ['team_one', 'team_two'])
                ->nullable();

            $table->enum('status', [
                'pending',
                'scheduled',
                'ongoing',
                'completed'
            ])->default('pending');

            $table->dateTime('scheduled_at')->nullable();

            $table->timestamps();

            $table->unique(['tournament_id', 'round', 'match_number']);
            $table->index(['tournament_id', 'round', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
