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
            'tipo_descripcion' => 'required|string|max:50',
            'marca_descripcion' => 'required|string|max:50',
            'modelo' => 'required|string|max:100',
            'IdCategoria' => 'required|integer|exists:categoria,IdCategoria',
            'detalle.CodUTES' => 'required|string|max:12|unique:detallepatrimonio,CodUTES',
            'detalle.CodInterno' => 'nullable|string|max:12|unique:detallepatrimonio,CodInterno',
            'detalle.Descripcion' => 'required|string|max:250',
            'detalle.Operativo' => 'required|boolean',
            'detalle.Baja' => 'required|boolean',
            'detalle.IdServicio' => 'required|integer|exists:servicio,IdServicio',
        ];
    }

    public function messages()
    {
        return [
            'tipo_descripcion.required' => 'La descripción del tipo es obligatoria.',
            'marca_descripcion.required' => 'La descripción de la marca es obligatoria.',
            'modelo.required' => 'El modelo es obligatorio.',
            'IdCategoria.required' => 'La categoría es obligatoria.',
            'IdCategoria.exists' => 'La categoría seleccionada no es válida.',
            'detalle.CodUTES.required' => 'El código UTES es obligatorio.',
            'detalle.CodUTES.max' => 'El código UTES no puede tener más de 12 caracteres.',
            'detalle.CodUTES.unique' => 'El código UTES ya está registrado.',
            'detalle.CodInterno.max' => 'El código interno no puede tener más de 12 caracteres.',
            'detalle.CodInterno.unique' => 'El código interno ya está registrado.',
            'detalle.Descripcion.required' => 'La descripción es obligatoria.',
            'detalle.Descripcion.max' => 'La descripción no puede tener más de 250 caracteres.',
            'detalle.Operativo.required' => 'El campo operativo es obligatorio.',
            'detalle.Baja.required' => 'El campo baja es obligatorio.',
            'detalle.IdServicio.required' => 'El campo de servicio es obligatorio.',
            'detalle.IdServicio.exists' => 'El servicio seleccionado no es válido.'
        ];
    }
}
