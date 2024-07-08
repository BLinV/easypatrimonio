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
            'CodigoBaja' => 'required|string|max:20',
            'Observacion' => 'nullable|string|max:100',
            'Estado' => 'nullable|string|max:100',
            
            // Tabla DetallePatrimonio
            'CodUTES' => 'required|string|size:12',
            'CodInterno' => 'nullable|string|max:12',
            // Tabla DetalleIngreso
            'Estado' => 'nullable|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'CodigoBaja.required' => 'El CÓDIGO DE BAJA es obligatorio.',
            'CodigoBaja.unique' => 'El CÓDIGO DE BAJA  ya está registrado.',
            'CodigoBaja.max' => 'El CÓDIGO DE BAJA no puede tener más de 20 caracteres.',
            
            'CodUTES.required' => 'El código UTES es obligatorio.',
            'CodUTES.size' => 'El código UTES debe tener 12 caracteres.',
            'CodInterno.max' => 'El código interno no puede tener más de 12 caracteres.',
            'Estado.max' => 'La Información Anexa no puede tener más de 50 caracteres.'
        ];
    }
}
