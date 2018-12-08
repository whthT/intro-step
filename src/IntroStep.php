<?php


namespace Whtht\IntroStep;

use Illuminate\Support\Facades\Facade;

use App\Models\IntroStepStepList;
use App\Models\IntroStepUserList;

class IntroStep extends Facade
{

    protected static function getFacadeAccessor()
    {
        return "introStep";
    }

    public static function viewWithIntro($view, $data = [], $mergeData = []) {
        $with = [];

        $step = IntroStepStepList::view($view);

        if($step) {
            $with = [
                "is_active" => filled($step),
                "is_auth" => auth()->check(),
                "is_auth_only" => $step->auth_only,
                "step" => $step,
                "route" => route("intro-step-admin.api.user.store")
            ];

            if(auth()->check()) {
                $userStep = IntroStepUserList::getUserStep($step);
                $with = array_merge(["user" => $userStep], $with);
            }
        }

        return view($view, $data, $mergeData)->with(["intro_step" => $with]);
    }

    public static function getBladeScript($withScript = true) {
        $passed = '<?php 
            if(isset($intro_step)) { ';
            $passed .= "echo '<script>window.IntroStep = '.json_encode(\$intro_step).';</script>';";
            if($withScript) {
                $passed .= "echo '<link rel=stylesheet href=\'".asset('vendor/whtht/intro-step/introjs.min.css')."\' />';";
                $passed .= "echo '<script src=\'".asset('vendor/whtht/intro-step/intro.min.js')."\'></script>'; ";
                $passed .= "echo '<script src=\'".asset('vendor/whtht/intro-step/intro-step.js')."\'></script>';";
            }
        $passed .= '}?>';

        return $passed;
    }
}