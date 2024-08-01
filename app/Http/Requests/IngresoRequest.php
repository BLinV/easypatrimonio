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
            'NumeroPecosa' => 'nullable|string|size:20',
            'IdOrigen' => 'required|integer|exists:origen,IdOrigen',
            'OtroOrigen' => 'nullable|string|max:255',
            'Observacion' => 'nullable|string|max:100',
            // Tabla Patrimonio
            'tipo_descripcion' => 'required|string|max:50',
            'marca_descripcion' => 'required|string|max:50',
            'Modelo' => 'required|string|max:100',
            'categoria_descripcion' => 'required|string|max:50',
            // Tabla DetallePatrimonio
            'CodInterno' => 'nullable|string|size:10|unique:detallepatrimonio,CodInterno',
            'CodUTES' => 'nullable|string|size:12|unique:detallepatrimonio,CodUTES',
            'CodServicio' => 'nullable|string|size:12|unique:detallepatrimonio,CodServicio',
            'Descripcion' => 'nullable|string|max:250',
            'IdServicio' => 'required|integer|exists:servicio,IdServicio',
            // Tabla DetalleIngreso
            'Estado' => 'nullable|string|max:50',
            // Tabla UbicacionPatrimonio
            'IdEncargado' => 'required|integer|exists:personal,IdPersonal',
        ];
    }

    public function messages()
    {
        return [
            'NumeroInterno.required' => 'El código Interno es obligatorio.',
            'NumeroInterno.size' => 'El código Interno debe tener 10 caracteres.',
            'NumeroPecosa.required' => 'El código PECOSA es obligatorio.',
            'NumeroPecosa.size' => 'El código de Pecosa debe tener 20 caracteres.',
            'tipo_descripcion.max' => 'La descripción no puede tener más de 50 caracteres.',
            'IdOrigen.required' => 'El origen es obligatorio.',
            'OtroOrigen.max' => 'La descripcion de Otro Origen no puede tener más de 255 caracteres.',
            'Observacion.max' => 'La Observación no puede tener más de 100 caracteres.',
            
            'tipo_descripcion.required' => 'La descripción del tipo es obligatoria.',
            'tipo_descripcion.max' => 'La descripción del tipo no puede tener más de 50 caracteres.',
            'marca_descripcion.required' => 'La descripción de la marca es obligatoria.',
            'marca_descripcion.max' => 'La descripción de la marca no puede tener más de 50 caracteres.',
            'Modelo.required' => 'El campo modelo es obligatorio.',
            'Modelo.max' => 'La descripción no puede tener más de 100 caracteres.',
            'categoria_descripcion.required' => 'La categoría es obligatoria.',
            'categoria_descripcion.max' => 'La descripción de la categoría no puede tener más de 50 caracteres.',

            'CodInterno.size' => 'El código interno debe tener 10 caracteres.',
            'CodInterno.unique' => 'El código interno ya está registrado.',
            'CodUTES.size' => 'El código UTES debe tener 12 caracteres.',
            'CodUTES.unique' => 'El código UTES ya está registrado.',
            'Descripcion.max' => 'La descripción no puede tener más de 250 caracteres.',
            'IdServicio.required' => 'El campo de Servicio es obligatorio.',
            'IdServicio.exists' => 'El Servicio seleccionado no es válido.',

            'Estado.max' => 'La Información Anexa no puede tener más de 50 caracteres.',

            'IdEncargado.required' => 'El campo de Personal es obligatorio.',
            'IdEncargado.exists' => 'El Personal seleccionado no es válido.',
            'IdEncargado.integer' => 'El Personal seleccionado no es válido.'
        ];
    }
}
