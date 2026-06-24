<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function index(): View
    {
        $teams = Team::where('owner_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.teams.index', compact('teams'));
    }

    public function create(): View
    {
        return view('user.teams.create');
    }

    public function store(StoreTeamRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['owner_id'] = auth()->id();

        Team::create($data);

        return redirect()
            ->route('user.teams.index')
            ->with('success', 'Tim/player berhasil dibuat.');
    }

    public function show(Team $team): View
    {
        $this->authorizeOwner($team);

        $team->load('tournamentParticipations.tournament');

        return view('user.teams.show', compact('team'));
    }

    public function edit(Team $team): View
    {
        $this->authorizeOwner($team);

        return view('user.teams.edit', compact('team'));
    }

    public function update(UpdateTeamRequest $request, Team $team): RedirectResponse
    {
        $this->authorizeOwner($team);

        $team->update($request->validated());

        return redirect()
            ->route('user.teams.index')
            ->with('success', 'Tim/player berhasil diperbarui.');
    }

    public function destroy(Team $team): RedirectResponse
    {
        $this->authorizeOwner($team);

        if ($team->tournamentParticipations()->exists()) {
            return redirect()
                ->route('user.teams.index')
                ->with('error', 'Tim/player ini sudah pernah daftar turnamen, jadi tidak boleh dihapus.');
        }

        $team->delete();

        return redirect()
            ->route('user.teams.index')
            ->with('success', 'Tim/player berhasil dihapus.');
    }

    private function authorizeOwner(Team $team): void
    {
        abort_if($team->owner_id !== auth()->id(), 403, 'Akses ditolak. Ini bukan tim/player lo.');
    }
}