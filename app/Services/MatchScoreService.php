<?php

namespace App\Services;

use App\Models\MatchModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class MatchScoreService
{
    public function updateScore(MatchModel $match, int $teamOneScore, int $teamTwoScore): void
    {
        DB::transaction(function () use ($match, $teamOneScore, $teamTwoScore) {
            $match->load([
                'tournament',
                'nextMatch',
            ]);

            if (! $match->team_one_id || ! $match->team_two_id) {
                throw ValidationException::withMessages([
                    'score' => 'Match belum lengkap. Kedua peserta harus sudah tersedia.',
                ]);
            }

            if ($teamOneScore === $teamTwoScore) {
                throw ValidationException::withMessages([
                    'score' => 'Skor tidak boleh seri pada sistem single elimination.',
                ]);
            }

            if ($match->nextMatch && $match->nextMatch->winner_id) {
                throw ValidationException::withMessages([
                    'score' => 'Skor match ini tidak bisa diubah karena match berikutnya sudah selesai.',
                ]);
            }

            $winnerId = $teamOneScore > $teamTwoScore
                ? $match->team_one_id
                : $match->team_two_id;

            $oldWinnerId = $match->winner_id;

            $match->update([
                'team_one_score' => $teamOneScore,
                'team_two_score' => $teamTwoScore,
                'winner_id' => $winnerId,
                'status' => 'completed',
            ]);

            if ($match->next_match_id) {
                $this->moveWinnerToNextMatch($match, $winnerId, $oldWinnerId);
            } else {
                $match->tournament->update([
                    'status' => 'completed',
                    'ended_at' => now(),
                ]);
            }
        });
    }

    private function moveWinnerToNextMatch(MatchModel $match, int $winnerId, ?int $oldWinnerId): void
    {
        $nextMatch = MatchModel::findOrFail($match->next_match_id);

        if ($match->next_match_slot === 'team_one') {
            if ($oldWinnerId && $nextMatch->team_one_id === $oldWinnerId) {
                $nextMatch->team_one_id = null;
            }

            $nextMatch->team_one_id = $winnerId;
        }

        if ($match->next_match_slot === 'team_two') {
            if ($oldWinnerId && $nextMatch->team_two_id === $oldWinnerId) {
                $nextMatch->team_two_id = null;
            }

            $nextMatch->team_two_id = $winnerId;
        }

        if ($nextMatch->team_one_id && $nextMatch->team_two_id) {
            $nextMatch->status = 'scheduled';
        }

        $nextMatch->save();
    }
}