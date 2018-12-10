<?php
/**
 * Created by PhpStorm.
 * User: Musa
 * Date: 3.12.2018
 * Time: 17:54
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class IntroStepUserList extends Model
{
    protected $table = "intro_step_user_list";
    protected $guarded = ["id"];

    public static function getUserStep(IntroStepStepList $step) {
        return self::where(config("intro-step.user_column"), auth()->user()->id)->where("intro_step_step_list_id", $step->id)->first();
    }

    public function _user_relationship() {
        return $this->belongsTo(config("intro-step.user_model"), config("intro-step.user_column"), "id");
    }
}