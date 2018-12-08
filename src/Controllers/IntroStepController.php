<?php

namespace Whtht\IntroStep\Controllers;

use Illuminate\Routing\Controller;

class IntroStepController extends Controller {

        public function index() {
            $defaultOptions = collect(config("intro-step.default_options"))->map(function ($item) {
                if(trans("intro_step::validation.".$item["value"]) != "intro_step::validation.".$item["value"]) {
                    $item["value"] = trans("intro_step::validation.".$item["value"]);
                }

                if(trans("intro_step::validation.".$item["attribute"]) != "intro_step::validation.".$item["attribute"]) {
                    $item["attribute"] = trans("intro_step::validation.".$item["attribute"]);
                }

                return $item;
            });


            $i18n = [
                "locale" => app()->getLocale(),
                "messages" => [
                    app()->getLocale() => collect(\Lang::get("intro_step::panel"))
                ]
            ];

            return view("intro_step::index", compact(["i18n", "defaultOptions"]));
        }

}