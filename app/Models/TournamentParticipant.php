<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TournamentParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'tournament_id',
        'team_id',
        'registered_by',
        'status',
        'seed_number',
        'approved_at',
        'rejected_at',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'rejected_at' => 'datetime',
        ];
    }

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function registeredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    public function matchesAsTeamOne(): HasMany
    {
        return $this->hasMany(MatchModel::class, 'team_one_id');
    }

    public function matchesAsTeamTwo(): HasMany
    {
        return $this->hasMany(MatchModel::class, 'team_two_id');
    }

    public function matchesWon(): HasMany
    {
        return $this->hasMany(MatchModel::class, 'winner_id');
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }
}
