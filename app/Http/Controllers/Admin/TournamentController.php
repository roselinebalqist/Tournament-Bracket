<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTournamentRequest;
use App\Http\Requests\UpdateTournamentRequest;
use App\Models\Tournament;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TournamentController extends Controller
{
    public function index(): View
    {
        $tournaments = Tournament::withCount(['participants', 'matches'])
            ->latest()
            ->paginate(10);

        return view('admin.tournaments.index', compact('tournaments'));
    }

    public function create(): View
    {
        return view('admin.tournaments.create');
    }

    public function store(StoreTournamentRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['created_by'] = auth()->id();
        $data['slug'] = $this->generateUniqueSlug($data['name']);
        $data['type'] = 'single_elimination';

        Tournament::create($data);

        return redirect()
            ->route('admin.tournaments.index')
            ->with('success', 'Turnamen berhasil dibuat.');
    }

    public function show(Tournament $tournament): View
{
    $tournament->load([
        'admin',
        'participants.team',
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

    return view('admin.tournaments.show', compact('tournament', 'matchesByRound'));
}

    public function edit(Tournament $tournament): View
    {
        return view('admin.tournaments.edit', compact('tournament'));
    }

    public function update(UpdateTournamentRequest $request, Tournament $tournament): RedirectResponse
    {
        $data = $request->validated();

        if ($tournament->name !== $data['name']) {
            $data['slug'] = $this->generateUniqueSlug($data['name'], $tournament->id);
        }

        $tournament->update($data);

        return redirect()
            ->route('admin.tournaments.index')
            ->with('success', 'Turnamen berhasil diperbarui.');
    }

    public function destroy(Tournament $tournament): RedirectResponse
    {
        if ($tournament->status === 'ongoing') {
            return redirect()
                ->route('admin.tournaments.index')
                ->with('error', 'Turnamen yang sedang berjalan tidak boleh dihapus.');
        }

        $tournament->delete();

        return redirect()
            ->route('admin.tournaments.index')
            ->with('success', 'Turnamen berhasil dihapus.');
    }

    private function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        while (
            Tournament::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}