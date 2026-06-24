<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateMatchScoreRequest;
use App\Models\MatchModel;
use App\Services\MatchScoreService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class MatchScoreController extends Controller
{
    public function edit(MatchModel $match): View
    {
        $match->load([
            'tournament',
            'teamOne.team',
            'teamTwo.team',
            'winner.team',
            'nextMatch',
        ]);

        return view('admin.matches.score', compact('match'));
    }

    public function update(
        UpdateMatchScoreRequest $request,
        MatchModel $match,
        MatchScoreService $matchScoreService
    ): RedirectResponse {
        try {
            $matchScoreService->updateScore(
                $match,
                (int) $request->validated()['team_one_score'],
                (int) $request->validated()['team_two_score']
            );

            return redirect()
                ->route('admin.tournaments.show', $match->tournament)
                ->with('success', 'Skor berhasil disimpan dan winner otomatis dinaikkan.');
        } catch (ValidationException $exception) {
            return back()
                ->withErrors($exception->errors())
                ->withInput();
        }
    }
}