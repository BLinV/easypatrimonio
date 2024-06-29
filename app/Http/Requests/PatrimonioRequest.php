<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatrimonioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // Tabla Patrimonio
            'tipo_descripcion' => 'required|string|max:50',
            'marca_descripcion' => 'required|string|max:50',
            'modelo' => 'required|string|max:100',
            'IdCategoria' => 'required|integer|exists:categoria,IdCategoria',
            // Tabla DetallePatrimonio
            'CodUTES' => 'required|string|size:12|unique:detallepatrimonio,CodUTES',
            'CodInterno' => 'nullable|string|max:12|unique:detallepatrimonio,CodInterno',
            'Descripcion' => 'required|string|max:250',
            'Operativo' => 'required|boolean',
            'Baja' => 'required|boolean',
            'IdServicio' => 'required|integer|exists:servicio,IdServicio',
        ];
    }

    public function messages()
    {
        return [
            'tipo_descripcion.required' => 'La descripción del tipo es obligatoria.',
            'tipo_descripcion.max' => 'La descripción no puede tener más de 50.',
            'marca_descripcion.required' => 'La descripción de la marca es obligatoria.',
            'modelo.required' => 'El modelo es obligatorio.',
            'IdCategoria.required' => 'La categoría es obligatoria.',
            'IdCategoria.exists' => 'La categoría seleccionada no es válida.',

            'CodUTES.required' => 'El código UTES es obligatorio.',
            'CodUTES.size' => 'El código UTES debe tener 12 caracteres.',
            'CodUTES.unique' => 'El código UTES ya está registrado.',
                        'CodInterno.required' => 'El código Interno es obligatorio.',
            'CodInterno.max' => 'El código interno no puede tener más de 12 caracteres.',
            'CodInterno.unique' => 'El código interno ya está registrado.',
            'Descripcion.required' => 'La descripción es obligatoria.',
            'Descripcion.max' => 'La descripción no puede tener más de 250 caracteres.',
            'Operativo.required' => 'El campo operativo es obligatorio.',
            'Baja.required' => 'El campo baja es obligatorio.',
            'IdServicio.required' => 'El campo de servicio es obligatorio.',
            'IdServicio.exists' => 'El servicio seleccionado no es válido.'
        ];
    }
}
