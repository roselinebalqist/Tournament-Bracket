<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('slug')->unique();
            $table->string('game_name');

            $table->text('description')->nullable();

            $table->enum('type', ['single_elimination'])
                ->default('single_elimination');

            $table->unsignedSmallInteger('max_participants')
                ->default(8);

            $table->enum('status', [
                'draft',
                'registration_open',
                'registration_closed',
                'ongoing',
                'completed',
                'cancelled'
            ])->default('draft');

            $table->dateTime('registration_start_at')->nullable();
            $table->dateTime('registration_end_at')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ended_at')->nullable();

            $table->timestamps();

            $table->index(['status', 'started_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
