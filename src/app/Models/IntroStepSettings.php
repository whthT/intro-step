<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class IntroStepSettings extends Model {
    protected $table = "intro_step_settings";

    protected $guarded  = ['id'];
    public $timestamps = false;

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

    public function getValueAttribute($value) {
        return in_array($this->key, $this->booleanOptions) ?
            boolval($value) :
            $value;

    }

    public function getRouteKeyName()
    {
        return "key";
    }

    public function getRouteKey()
    {
        return "key";
    }
}