<?php

namespace Whtht\IntroStep\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Models\IntroStepSettings;

use App\Http\Requests\IntroStep\Api\Options\Store;

class OptionsController extends Controller
{

    /**
     * @return mixed
     */
    public function index() {
        return IntroStepSettings::get()->pluck("value", "key");
    }

    /**
     * @param Store $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Store $request) {
        foreach ($request->only(["buttonClass", "disableInteraction", "doneLabel", "exitOnEsc", "exitOnOverlayClick", "helperElementPadding", "hideNext", "hidePrev", "highlightClass", "hintAnimation", "hintButtonLabel", "hintPosition", "keyboardNavigation", "nextLabel", "overlayOpacity", "prevLabel", "scrollPadding", "scrollTo", "scrollToElement", "showBullets", "showButtons", "showProgress", "showStepNumbers", "skipLabel", "tooltipClass", "tooltipPosition"]) as $key => $val) {
            IntroStepSettings::where("key", $key)->update(["value" => $val]);
        }
        return response()->json(["status" => "success", "message" => trans("intro_step::messages.optionSaveSuccess")]);
    }
}