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
            'CodigoBaja' => 'required|string|size:10',
            'Observacion' => 'nullable|string|max:100',
            'Estado' => 'nullable|string|max:100',
            // Tabla DetallePatrimonio
            'CodInterno' => 'nullable|string|max:12',
            // Tabla DetalleIngreso
            'Estado' => 'nullable|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'CodigoBaja.required' => 'El CÓDIGO DE BAJA es obligatorio.',
            'CodigoBaja.size' => 'El CÓDIGO DE BAJA no puede tener 10 caracteres.',
            'Observacion.max' => 'Las OBSERVACIONES no puede tener más de 100 caracteres.',
            
            'CodInterno.max' => 'El código interno no puede tener más de 12 caracteres.',
            'Estado.max' => 'La Información Anexa no puede tener más de 50 caracteres.'
        ];
    }
}
