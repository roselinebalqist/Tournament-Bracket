<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'participant_type',
        'name',
        'contact_email',
        'contact_phone',
        'institution',
        'logo',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function tournamentParticipations(): HasMany
    {
        return $this->hasMany(TournamentParticipant::class);
    }
}
