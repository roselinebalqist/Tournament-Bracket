<?php

namespace App\Http\Requests;

use App\Models\TournamentParticipant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTournamentRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'user';
    }

    public function rules(): array
    {
        return [
            'team_id' => [
                'required',
                'integer',
                Rule::exists('teams', 'id')->where(function ($query) {
                    return $query->where('owner_id', $this->user()->id);
                }),
            ],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $tournament = $this->route('tournament');
            $teamId = $this->input('team_id');

            if (! $tournament) {
                return;
            }

            if ($tournament->status !== 'registration_open') {
                $validator->errors()->add(
                    'team_id',
                    'Pendaftaran turnamen ini sedang tidak dibuka.'
                );
            }

            if ($teamId && TournamentParticipant::where('tournament_id', $tournament->id)
                ->where('team_id', $teamId)
                ->exists()) {
                $validator->errors()->add(
                    'team_id',
                    'Tim/player ini sudah terdaftar di turnamen tersebut.'
                );
            }

            if ($tournament->approvedParticipants()->count() >= $tournament->max_participants) {
                $validator->errors()->add(
                    'team_id',
                    'Slot peserta turnamen sudah penuh.'
                );
            }
        });
    }

    public function messages(): array
    {
        return [
            'team_id.required' => 'Pilih tim/player terlebih dahulu.',
            'team_id.exists' => 'Tim/player tidak valid atau bukan milik lo.',
        ];
    }
}