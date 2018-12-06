<?php


namespace Whtht\IntroStep\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Models\IntroStepStepList;

class IndexController extends Controller
{
    public function index() {
        return IntroStepStepList::select("id", "name")->with("_intro_step_user_list_id:id,intro_step_step_list_id,is_completed,".config("intro-step.user_column"))->get()->map(function($item) {
            return [
                "id" => $item->id,
                "name" => $item->name,
                "participant_count" => $item->_intro_step_user_list_id->count(),
                "complete_count" => $item->_intro_step_user_list_id->where("is_completed", true)->count()
            ];
        });
    }
}