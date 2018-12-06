<?php

namespace App\Http\Requests\IntroStep\Api\Steps;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            "name" => "required|string",
            "view_path" => "required|string",
            "steps" => "required|array",
            "options" => "required|array"
        ];
    }
}