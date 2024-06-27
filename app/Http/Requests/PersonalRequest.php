<?php

namespace App\Http\Requests;

use App\Models\Personal;
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
            'dni' => 'required|unique:personal,Dni',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'celular' => 'required|string|max:9',
            'condicion' => 'required|integer',
            'servicio' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'dni.required' => 'El DNI es obligatorio.',
            'dni.unique' => 'El DNI ya está registrado.',
            'dni.max' => 'El DNI no puede tener más de 8 caracteres.',
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'celular.required' => 'El celular es obligatorio.',
            'celular.max' => 'El celular no puede tener más de 9 caracteres.',
            'condicion.required' => 'La condición es obligatoria.',
            'servicio.required' => 'El servicio es obligatorio.',
        ];
    }
}
