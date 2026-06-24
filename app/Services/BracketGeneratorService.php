<?php

namespace App\Services;

use App\Models\MatchModel;
use App\Models\Tournament;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BracketGeneratorService
{
    public function generate(Tournament $tournament): void
    {
        DB::transaction(function () use ($tournament) {
            if ($tournament->matches()->exists()) {
                throw ValidationException::withMessages([
                    'bracket' => 'Bracket untuk turnamen ini sudah pernah dibuat.',
                ]);
            }

            $participants = $tournament->approvedParticipants()
                ->with('team')
                ->inRandomOrder()
                ->get();

            $participantCount = $participants->count();

            if (! in_array($participantCount, [4, 8, 16], true)) {
                throw ValidationException::withMessages([
                    'bracket' => 'Jumlah peserta approved harus 4, 8, atau 16 untuk generate bracket.',
                ]);
            }

            if ($participantCount !== (int) $tournament->max_participants) {
                throw ValidationException::withMessages([
                    'bracket' => 'Jumlah peserta approved harus sama dengan maksimal peserta turnamen.',
                ]);
            }

            foreach ($participants as $index => $participant) {
                $participant->update([
                    'seed_number' => $index + 1,
                ]);
            }

            $totalRounds = (int) log($participantCount, 2);
            $matchesByRound = [];

            for ($round = 1; $round <= $totalRounds; $round++) {
                $matchCount = $participantCount / (2 ** $round);

                for ($matchNumber = 1; $matchNumber <= $matchCount; $matchNumber++) {
                    $matchesByRound[$round][$matchNumber] = MatchModel::create([
                        'tournament_id' => $tournament->id,
                        'round' => $round,
                        'match_number' => $matchNumber,
                        'status' => $round === 1 ? 'scheduled' : 'pending',
                    ]);
                }
            }

            $participantIndex = 0;

            foreach ($matchesByRound[1] as $match) {
                $match->update([
                    'team_one_id' => $participants[$participantIndex]->id,
                    'team_two_id' => $participants[$participantIndex + 1]->id,
                ]);

                $participantIndex += 2;
            }

            for ($round = 1; $round < $totalRounds; $round++) {
                foreach ($matchesByRound[$round] as $matchNumber => $match) {
                    $nextMatchNumber = (int) ceil($matchNumber / 2);
                    $nextSlot = $matchNumber % 2 === 1 ? 'team_one' : 'team_two';

                    $match->update([
                        'next_match_id' => $matchesByRound[$round + 1][$nextMatchNumber]->id,
                        'next_match_slot' => $nextSlot,
                    ]);
                }
            }

            $tournament->update([
                'status' => 'ongoing',
                'started_at' => $tournament->started_at ?? now(),
            ]);
        });
    }
}