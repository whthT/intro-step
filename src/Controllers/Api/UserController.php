<?php

namespace Whtht\IntroStep\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Models\IntroStepUserList;
use App\Models\IntroStepStepList;

class UserController extends Controller
{
    public function store(Request $request) {


        $request->validate(["step_id" => "bail|required|integer|exists:intro_step_step_list,id"]);

        $step = IntroStepStepList::findOrFail($request->step_id);

        if(auth()->check()) {
            $userStep = IntroStepUserList::getUserStep($step);
            $db = [
                "last_action" => now(),
                "is_completed" => $request->complete,
                "last_step" => $request->last_step,
                "completed_at" => $request->complete ? now() : null
            ];
            if($userStep && !$userStep->is_completed) {

                $userStep->update($db);

            } elseif(!$userStep) {
                IntroStepUserList::create(array_merge([
                    config("intro-step.user_column") => auth()->user()->id,
                    "intro_step_step_list_id" => $step->id
                ], $db));
            }

        }
        return response()->json([], 204);
    }
}