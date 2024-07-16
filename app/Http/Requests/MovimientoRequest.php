<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovimientoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'CodInterno' => 'required|string|size:12|exists:detallepatrimonio,CodInterno',
            'IdPersonal' => 'required|integer|exists:personal,IdPersonal',
            'IdServicio' => 'required|integer|exists:servicio,IdServicio',
            'Motivo' => 'required|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'CodInterno.required' => 'El código Interno es obligatorio.',
            'CodInterno.size' => 'El código interno debe tener 12 caracteres.',
            'CodInterno.exists' => 'El código interno debe estar registrado.',
            'IdPersonal.required' => 'El campo de personal es obligatorio.',
            'IdPersonal.exists' => 'El personal seleccionado no es válido.',
            'IdServicio.required' => 'El campo de servicio es obligatorio.',
            'IdServicio.exists' => 'El servicio seleccionado no es válido.',
            'Motivo.required' => 'El motivo es obligatoria.',
            'Motivo.max' => 'El motivo no puede tener más de 100 caracteres.'
        ];
    }
}
