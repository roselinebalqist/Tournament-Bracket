<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTournamentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'game_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'max_participants' => ['required', 'integer', 'in:4,8,16'],
            'status' => [
                'required',
                'in:draft,registration_open,registration_closed,ongoing,completed,cancelled'
            ],
            'registration_start_at' => ['nullable', 'date'],
            'registration_end_at' => ['nullable', 'date', 'after_or_equal:registration_start_at'],
            'started_at' => ['nullable', 'date', 'after_or_equal:registration_end_at'],
            'ended_at' => ['nullable', 'date', 'after_or_equal:started_at'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama turnamen wajib diisi.',
            'game_name.required' => 'Nama game wajib diisi.',
            'max_participants.required' => 'Jumlah maksimal peserta wajib dipilih.',
            'max_participants.in' => 'Jumlah peserta hanya boleh 4, 8, atau 16.',
            'registration_end_at.after_or_equal' => 'Tanggal akhir pendaftaran tidak boleh sebelum tanggal mulai pendaftaran.',
            'started_at.after_or_equal' => 'Tanggal mulai turnamen tidak boleh sebelum pendaftaran selesai.',
            'ended_at.after_or_equal' => 'Tanggal selesai turnamen tidak boleh sebelum turnamen dimulai.',
        ];
    }
}