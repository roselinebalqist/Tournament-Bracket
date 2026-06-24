<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Services\BracketGeneratorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class BracketController extends Controller
{
    public function generate(
        Tournament $tournament,
        BracketGeneratorService $bracketGeneratorService
    ): RedirectResponse {
        try {
            $bracketGeneratorService->generate($tournament);

            return redirect()
                ->route('admin.tournaments.show', $tournament)
                ->with('success', 'Bracket berhasil dibuat otomatis.');
        } catch (ValidationException $exception) {
            return redirect()
                ->route('admin.tournaments.show', $tournament)
                ->withErrors($exception->errors())
                ->withInput();
        }
    }
}