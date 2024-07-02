<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateJabatanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'jenis_jabatan_id' => 'required',
            'eselon_id' => 'required',
            'golongan_id' => 'required',
            'kode' => 'nullable',
            'unit_kerja_id' => 'required',
            'parent_id' => 'nullable',
            // 'kelas_jabatan' => 'required',
            // 'ikhtisar' => 'required',
            // 'prestasi' => 'required',
            // 'tanggung_jawab' => 'required',
        ];
    }
}
