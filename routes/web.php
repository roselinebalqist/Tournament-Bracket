<?php

use App\Http\Controllers\Admin\MatchScoreController as AdminMatchScoreController;
use App\Http\Controllers\Admin\BracketController as AdminBracketController;
use App\Http\Controllers\Admin\ParticipantApprovalController as AdminParticipantApprovalController;
use App\Http\Controllers\User\TournamentController as UserTournamentController;
use App\Http\Controllers\User\TournamentRegistrationController as UserTournamentRegistrationController;
use App\Http\Controllers\Admin\TournamentController as AdminTournamentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\TeamController as UserTeamController;
use App\Http\Controllers\PublicTournamentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tournaments', [PublicTournamentController::class, 'index'])
    ->name('public.tournaments.index');

Route::get('/tournaments/{tournament:slug}/bracket', [PublicTournamentController::class, 'bracket'])
    ->name('public.tournaments.bracket');
    
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('tournaments', AdminTournamentController::class);

        Route::get(
            '/tournaments/{tournament}/participants',
            [AdminParticipantApprovalController::class, 'index']
        )->name('tournaments.participants.index');

        Route::patch(
            '/participants/{participant}/approve',
            [AdminParticipantApprovalController::class, 'approve']
        )->name('participants.approve');

        Route::patch(
            '/participants/{participant}/reject',
            [AdminParticipantApprovalController::class, 'reject']
        )->name('participants.reject');

        Route::post(
            '/tournaments/{tournament}/generate-bracket',
            [AdminBracketController::class, 'generate']
        )->name('tournaments.generate-bracket');

        Route::get(
            '/matches/{match}/score',
            [AdminMatchScoreController::class, 'edit']
        )->name('matches.score.edit');

        Route::patch(
            '/matches/{match}/score',
            [AdminMatchScoreController::class, 'update']
        )->name('matches.score.update');
    });

Route::middleware(['auth', 'verified', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('user.dashboard');
        })->name('dashboard');

        Route::resource('teams', UserTeamController::class);

        Route::get('/tournaments', [UserTournamentController::class, 'index'])
            ->name('tournaments.index');

        Route::get('/tournaments/{tournament}', [UserTournamentController::class, 'show'])
            ->name('tournaments.show');

        Route::post('/tournaments/{tournament}/register', [UserTournamentRegistrationController::class, 'store'])
            ->name('tournaments.register');

        Route::delete('/registrations/{participant}', [UserTournamentRegistrationController::class, 'destroy'])
            ->name('registrations.destroy');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';