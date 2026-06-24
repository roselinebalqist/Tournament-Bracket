<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Illuminate\View\View;

class PublicTournamentController extends Controller
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
            ->paginate(12);

        return view('public.tournaments.index', compact('tournaments'));
    }

    public function bracket(Tournament $tournament): View
    {
        $tournament->load([
            'approvedParticipants.team',
            'matches' => function ($query) {
                $query->with([
                    'teamOne.team',
                    'teamTwo.team',
                    'winner.team',
                    'nextMatch',
                ])->orderBy('round')->orderBy('match_number');
            },
        ]);

        $matchesByRound = $tournament->matches->groupBy('round');

        $finalMatch = $tournament->matches
            ->sortByDesc('round')
            ->first();

        return view('public.tournaments.bracket', compact(
            'tournament',
            'matchesByRound',
            'finalMatch'
        ));
    }
}