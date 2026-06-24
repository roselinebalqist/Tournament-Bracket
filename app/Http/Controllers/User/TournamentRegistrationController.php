<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTournamentRegistrationRequest;
use App\Models\Tournament;
use App\Models\TournamentParticipant;
use Illuminate\Http\RedirectResponse;

class TournamentRegistrationController extends Controller
{
    public function store(
        StoreTournamentRegistrationRequest $request,
        Tournament $tournament
    ): RedirectResponse {
        TournamentParticipant::create([
            'tournament_id' => $tournament->id,
            'team_id' => $request->validated()['team_id'],
            'registered_by' => auth()->id(),
            'status' => 'pending',
        ]);

        return redirect()
            ->route('user.tournaments.show', $tournament)
            ->with('success', 'Berhasil daftar turnamen. Sekarang tunggu admin approve, karena hidup memang penuh approval.');
    }

    public function destroy(TournamentParticipant $participant): RedirectResponse
    {
        abort_if(
            $participant->registered_by !== auth()->id(),
            403,
            'Akses ditolak. Ini bukan pendaftaran lo.'
        );

        if ($participant->status !== 'pending') {
            return back()->with('error', 'Pendaftaran yang sudah diproses admin tidak bisa dibatalkan.');
        }

        $participant->delete();

        return back()->with('success', 'Pendaftaran berhasil dibatalkan.');
    }
}