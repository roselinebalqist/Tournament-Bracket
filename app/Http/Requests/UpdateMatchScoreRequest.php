<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMatchScoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'team_one_score' => ['required', 'integer', 'min:0', 'max:999'],
            'team_two_score' => ['required', 'integer', 'min:0', 'max:999', 'different:team_one_score'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $match = $this->route('match');

            if (! $match) {
                return;
            }

            if (! $match->team_one_id || ! $match->team_two_id) {
                $validator->errors()->add(
                    'team_one_score',
                    'Match belum lengkap. Kedua peserta harus sudah tersedia.'
                );
            }

            if ($match->nextMatch && $match->nextMatch->winner_id) {
                $validator->errors()->add(
                    'team_one_score',
                    'Skor match ini tidak bisa diubah karena match berikutnya sudah selesai.'
                );
            }
        });
    }

    public function messages(): array
    {
        return [
            'team_one_score.required' => 'Skor peserta pertama wajib diisi.',
            'team_two_score.required' => 'Skor peserta kedua wajib diisi.',
            'team_one_score.integer' => 'Skor peserta pertama harus berupa angka.',
            'team_two_score.integer' => 'Skor peserta kedua harus berupa angka.',
            'team_two_score.different' => 'Skor tidak boleh seri pada sistem single elimination.',
            'team_one_score.min' => 'Skor tidak boleh kurang dari 0.',
            'team_two_score.min' => 'Skor tidak boleh kurang dari 0.',
        ];
    }
}