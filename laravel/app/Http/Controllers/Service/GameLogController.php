<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Services\System\AccessLogService;
use Services\GameLog\GameLog;
use Services\Mongo\UserEventLog;

class GameLogController extends ApiController{

    
    public function createGameLog(Request $request){

        $data = $request->get('data','');

        $gameLog = GameLog::decode($data);

        //$params['attribute'] = json_decode($params['attribute'],true);
        $log = UserEventLog::create($gameLog);
        return $this->success($log);
    }
}
