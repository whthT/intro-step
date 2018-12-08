<?php

namespace Whtht\IntroStep\Controllers\Api;

use Illuminate\Routing\Controller;

use App\Models\IntroStepStepList;

use App\Http\Requests\IntroStep\Api\Steps\Store;

class StepsController extends Controller {

    public function index() {
        return IntroStepStepList::get();
    }


    public function store(Store $request) {

        $steps = collect();
        $stepList = collect($request->steps)->filter(function ($item) {
            return  filled($item['selector']) &&
                    filled($item['intro']) &&
                    filled($item['position']) &&
                    count($item['position']);

        });

        foreach ($stepList as $value) {
            $steps->push([
                "element" => $value['selector'],
                "intro" => $value["intro"],
                "position" => $value["position"]
            ]);
        }

        $step = IntroStepStepList::create([
            "name" => $request->name,
            "view_path" => $request->view_path,
            "auth_only" => $request->auth_only ? true : false,
            "step_info" => collect([
                "options" => collect($request->options),
                "steps" => $steps
            ])->toJson()
        ]);


        if($step) {
            return response()->json(["status" => "success", "message" => trans("intro_step::messages.stepCreateSuccess")]);
        } else {
            return response()->json(["status" => "danger", "message" => trans("intro_step::messages.stepCreateDanger")]);
        }
    }

    public function update(Store $request, $id) {
        $step = IntroStepStepList::findOrFail($id);
        $steps = collect();
        $stepList = collect($request->steps)->filter(function ($item) {
            return  filled($item['selector']) &&
                filled($item['intro']) &&
                filled($item['position']) &&
                count($item['position']);

        });

        foreach ($stepList as $value) {
            $steps->push([
                "element" => $value['selector'],
                "intro" => $value["intro"],
                "position" => $value["position"]
            ]);
        }

        $step->update([
            "name" => $request->name,
            "view_path" => $request->view_path,
            "auth_only" => $request->auth_only ? true : false,
            "step_info" => collect([
                "options" => collect($request->options),
                "steps" => $steps
            ])->toJson()
        ]);

        if($step) {
            return response()->json(["status" => "success", "message" => trans("intro_step::messages.stepUpdateSuccess")]);
        } else {
            return response()->json(["status" => "danger", "message" => trans("intro_step::messages.stepUpdateDanger")]);
        }
    }

    public function show($id) {
        return IntroStepStepList::findOrFail($id);
    }

    public function destroy($step) {
        $step = IntroStepStepList::findOrFail($step);
        $step->delete();

        return response()->json(["status" => "success", "message" => trans("intro_step::messages.stepDeleteSuccess")]);
    }
}