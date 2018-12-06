<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntroStepStepList extends Model
{
    protected $table = "intro_step_step_list";
    protected $guarded = ["id"];

    public $booleanOptions = [
        "exitOnEsc",
        "hideNext",
        "hidePrev",
        "hintAnimation",
        "exitOnOverlayClick",
        "keyboardNavigation",
        "scrollToElement",
        "showBullets",
        "showButtons",
        "showProgress",
        "showStepNumbers",
        "disableInteraction"
    ];

    public function getStepInfoAttribute($value) {
        return $value && (is_object(json_decode($value)) || is_array(json_decode($value)))
            ? json_decode($value)
            : $value;
    }

    public static function view($view) {
        return self::where("view_path", $view)->first();
    }

    public function _intro_step_user_list_id() {
        return $this->hasMany("App\Models\IntroStepUserList", "intro_step_step_list_id", "id")->with("_user_relationship");
    }
}