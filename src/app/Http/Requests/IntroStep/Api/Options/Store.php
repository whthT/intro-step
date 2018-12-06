<?php

namespace App\Http\Requests\IntroStep\Api\Options;

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
            "buttonClass" => "nullable|string",
            "doneLabel" => "nullable|string",
            "helperElementPadding" => "nullable|string",
            "highlightClass" => "nullable|string",
            "hintButtonLabel" => "nullable|string",
            "hintPosition" => "nullable|string",
            "nextLabel" => "nullable|string",
            "overlayOpacity" => "nullable|string",
            "prevLabel" => "nullable|string",
            "scrollPadding" => "nullable|string",
            "scrollTo" => "nullable|string",
            "skipLabel" => "nullable|string",
            "tooltipClass" => "nullable|string",
            "tooltipPosition" => "nullable|string",
            "exitOnEsc" => "nullable|boolean",
            "hideNext" => "nullable|boolean",
            "hidePrev" => "nullable|boolean",
            "hintAnimation" => "nullable|boolean",
            "exitOnOverlayClick" => "nullable|boolean",
            "keyboardNavigation" => "nullable|boolean",
            "scrollToElement" => "nullable|boolean",
            "showBullets" => "nullable|boolean",
            "showButtons" => "nullable|boolean",
            "showProgress" => "nullable|boolean",
            "showStepNumbers" => "nullable|boolean",
            "disableInteraction" => "nullable|boolean",
        ];
    }
}