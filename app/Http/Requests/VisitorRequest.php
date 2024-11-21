<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'member_id' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:15',
            'purpose' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama pengunjung wajib diisi',
            'purpose.required' => 'Tujuan kunjungan wajib diisi',
        ];
    }
}
