<?php

namespace App\Http\Requests\IntroStep\Api\Steps;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    public function __construct()
    {
        parent::__construct();

        $this->defaultOptions = config("intro-step.default_options");

        $this->rulesArray = [
            "name" => "required|string",
            "view_path" => "required|string",
            "steps" => "required|array",
            "options" => "required|array"
        ];

        $this->attributesArray = [
            "name" => trans("intro_step::validation.name"),
            "view_path" => trans("intro_step::validation.view_path"),
            "auth_only" => trans("intro_step::validation.auth_only")
        ];

        foreach ($this->defaultOptions as $key => $value) {
            $this->rulesArray[$key] = $value["rule"];

            $trans = trans("intro_step::validation.".$value["attribute"]);

            $this->attributesArray[$key] = $trans != ("intro_step::validation.".$value["attribute"]) ?
                $trans : $value["attribute"];
        }

    }

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return $this->rulesArray;
    }

    public function attributes()
    {
        return $this->attributesArray;
    }
}