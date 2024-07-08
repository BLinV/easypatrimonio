<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Dni' => 'required|string|unique:personal,Dni|size:8',
            'Nombres' => 'required|string|max:255',
            'Apellidos' => 'required|string|max:255',
            'Celular' => 'required|string|max:9',
            'IdCondicion' => 'required|integer',
            'IdServicio' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'Dni.required' => 'El DNI es obligatorio.',
            'Dni.unique' => 'El DNI ya está registrado.',
            'Dni.size' => 'El DNI debe tener 8 caracteres.',
            'Nombres.required' => 'El nombre es obligatorio.',
            'Apellidos.required' => 'El apellido es obligatorio.',
            'Celular.required' => 'El celular es obligatorio.',
            'Celular.max' => 'El celular no puede tener más de 9 caracteres.',
            'IdCondicion.required' => 'La condición es obligatoria.',
            'IdServicio.required' => 'El servicio es obligatorio.',
        ];
    }
}
