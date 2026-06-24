<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\View\View;

class TournamentController extends Controller
{
    public function index(): View
    {
        $tournaments = Tournament::withCount(['approvedParticipants', 'matches'])
            ->whereIn('status', [
                'registration_open',
                'registration_closed',
                'ongoing',
                'completed',
            ])
            ->latest()
            ->paginate(10);

        return view('user.tournaments.index', compact('tournaments'));
    }

    public function show(Tournament $tournament): View
    {
        $tournament->load([
            'approvedParticipants.team',
            'matches.teamOne.team',
            'matches.teamTwo.team',
            'matches.winner.team',
        ]);

        $teams = Team::where('owner_id', auth()->id())
            ->latest()
            ->get();

        $userTeamIds = $teams->pluck('id');

        $userRegistrations = $tournament->participants()
            ->whereIn('team_id', $userTeamIds)
            ->with('team')
            ->latest()
            ->get();

        return view('user.tournaments.show', compact(
            'tournament',
            'teams',
            'userRegistrations'
        ));
    }
}