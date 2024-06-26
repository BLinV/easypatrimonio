<?php

namespace App\Http\Requests;

use App\Models\Personal;
use Illuminate\Foundation\Http\FormRequest;

class PersonalRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
