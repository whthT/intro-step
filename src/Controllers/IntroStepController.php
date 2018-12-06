<?php

namespace Whtht\IntroStep\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Models\IntroStepSettings;

class IntroStepController extends Controller {

        public function index(Request $request) {

            return view("intro_step::index", compact("intro-step"));
        }

}