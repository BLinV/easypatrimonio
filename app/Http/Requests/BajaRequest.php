<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BajaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'codigobaja' => 'required|string|max:20|unique:baja,CodigoBaja',
            'observacion' => 'required|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'codigobaja.required' => 'El CÓDIGO DE BAJA es obligatorio.',
            'codigobaja.unique' => 'El CÓDIGO DE BAJA  ya está registrado.',
            'codigobaja.max' => 'El CÓDIGO DE BAJA no puede tener más de 20 caracteres.',
        ];
    }
}
