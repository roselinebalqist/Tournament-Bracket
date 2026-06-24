<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'user';
    }

    public function rules(): array
    {
        $teamId = $this->route('team')?->id;

        return [
            'participant_type' => ['required', 'in:team,player'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('teams')->where(function ($query) {
                    return $query->where('owner_id', $this->user()->id);
                })->ignore($teamId),
            ],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:30'],
            'institution' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'participant_type.required' => 'Tipe peserta wajib dipilih.',
            'participant_type.in' => 'Tipe peserta hanya boleh team atau player.',
            'name.required' => 'Nama tim/player wajib diisi.',
            'name.unique' => 'Nama tim/player ini sudah pernah lo buat.',
            'contact_email.email' => 'Format email kontak tidak valid.',
        ];
    }
}