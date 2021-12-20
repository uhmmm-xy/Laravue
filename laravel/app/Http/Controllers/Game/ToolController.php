<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Facades\Games;

class ToolController extends Controller
{

    public function getUser(Request $request){

        $userId = $request->get('userId',0);
        $nickname = $request->get('nickname','');

        $user = Games::getRoleInfo($userId,$nickname);

        if(!$user){
           return $this->failed('查无此人');
        }

        return $this->success($user);
    }
}
