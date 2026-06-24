<?php

namespace Database\Seeders;

use App\Models\Tournament;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TournamentSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        Tournament::create([
            'created_by' => $admin->id,
            'name' => 'Campus Esports Cup 2026',
            'slug' => Str::slug('Campus Esports Cup 2026'),
            'game_name' => 'Mobile Legends',
            'description' => 'Turnamen single elimination untuk peserta kampus.',
            'type' => 'single_elimination',
            'max_participants' => 8,
            'status' => 'registration_open',
            'registration_start_at' => now(),
            'registration_end_at' => now()->addDays(7),
            'started_at' => now()->addDays(10),
        ]);
    }
}
