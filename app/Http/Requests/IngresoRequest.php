<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngresoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'codpecosa' => 'required|string|max:12',
            'origen' => 'required|string|max:50',
            'otroorigen' => 'nullable|string|max:100',

            'listaPatrimonio' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'codpecosa.required' => 'El código PECOSA es obligatorio.',
            'origen.required' => 'El origen es obligatorio.',
            'listaPatrimonio.required' => 'Debe proporcionar al menos un patrimonio.',
        ];
    }
}
