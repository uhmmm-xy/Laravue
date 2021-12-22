<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Facades\Games;

class ToolController extends Controller
{

    public function getUser(Request $request)
    {

        $userId = $request->get('roleId', 0);
        $nickname = $request->get('nickname', '');

        $user = Games::getRoleInfo($userId, $nickname);

        if (!$user) {
            return $this->failed('查无此人');
        }

        return $this->success($user);
    }

    public function setUserStatus(Request $request)
    {
        $uid = $request->get('uid');
        $status = $request->get('status');

        $ret = Games::updateUserStatus(1, $uid, $status);

        if (!$ret)
            return $this->failed('系统错误');
        return $this->success();
    }
}
