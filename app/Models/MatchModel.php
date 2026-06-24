<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MatchModel extends Model
{
    use HasFactory;

    protected $table = 'matches';

    protected $fillable = [
        'tournament_id',
        'round',
        'match_number',
        'team_one_id',
        'team_two_id',
        'team_one_score',
        'team_two_score',
        'winner_id',
        'next_match_id',
        'next_match_slot',
        'status',
        'scheduled_at',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
        ];
    }

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }

    public function teamOne(): BelongsTo
    {
        return $this->belongsTo(TournamentParticipant::class, 'team_one_id');
    }

    public function teamTwo(): BelongsTo
    {
        return $this->belongsTo(TournamentParticipant::class, 'team_two_id');
    }

    public function winner(): BelongsTo
    {
        return $this->belongsTo(TournamentParticipant::class, 'winner_id');
    }

    public function nextMatch(): BelongsTo
    {
        return $this->belongsTo(MatchModel::class, 'next_match_id');
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }
}
