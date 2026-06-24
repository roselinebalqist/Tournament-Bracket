<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Models\TournamentParticipant;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ParticipantApprovalController extends Controller
{
    public function index(Tournament $tournament): View
    {
        $participants = $tournament->participants()
            ->with(['team.owner', 'registeredBy'])
            ->latest()
            ->paginate(10);

        $approvedCount = $tournament->approvedParticipants()->count();

        return view('admin.participants.index', compact(
            'tournament',
            'participants',
            'approvedCount'
        ));
    }

    public function approve(TournamentParticipant $participant): RedirectResponse
    {
        $tournament = $participant->tournament;

        if (in_array($tournament->status, ['ongoing', 'completed'], true)) {
            return back()->with('error', 'Turnamen yang sudah berjalan/selesai tidak bisa mengubah approval peserta.');
        }

        if (
            $participant->status !== 'approved'
            && $tournament->approvedParticipants()->count() >= $tournament->max_participants
        ) {
            return back()->with('error', 'Slot peserta sudah penuh.');
        }

        $participant->update([
            'status' => 'approved',
            'approved_at' => now(),
            'rejected_at' => null,
        ]);

        return back()->with('success', 'Peserta berhasil di-approve.');
    }

    public function reject(TournamentParticipant $participant): RedirectResponse
    {
        $tournament = $participant->tournament;

        if (in_array($tournament->status, ['ongoing', 'completed'], true)) {
            return back()->with('error', 'Turnamen yang sudah berjalan/selesai tidak bisa mengubah approval peserta.');
        }

        $participant->update([
            'status' => 'rejected',
            'approved_at' => null,
            'rejected_at' => now(),
        ]);

        return back()->with('success', 'Peserta berhasil ditolak.');
    }
}