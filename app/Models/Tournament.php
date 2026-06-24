<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tournament extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'name',
        'slug',
        'game_name',
        'description',
        'type',
        'max_participants',
        'status',
        'registration_start_at',
        'registration_end_at',
        'started_at',
        'ended_at',
    ];

    protected function casts(): array
    {
        return [
            'registration_start_at' => 'datetime',
            'registration_end_at' => 'datetime',
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
        ];
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function participants(): HasMany
    {
        return $this->hasMany(TournamentParticipant::class);
    }

    public function approvedParticipants(): HasMany
    {
        return $this->hasMany(TournamentParticipant::class)
            ->where('status', 'approved');
    }

    public function matches(): HasMany
    {
        return $this->hasMany(MatchModel::class);
    }

    public function isRegistrationOpen(): bool
    {
        return $this->status === 'registration_open';
    }

    public function isOngoing(): bool
    {
        return $this->status === 'ongoing';
    }
}
