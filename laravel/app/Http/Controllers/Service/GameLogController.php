<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Services\System\AccessLogService;
use Services\Mongo\UserEventLog;

class GameLogController extends ApiController{

    
    public function createGameLog(Request $request){

        $data = $request->get('data','');

        $params = $request->only([
            'user_id',
            'role_id',
            'server_id',
            'dev_id' ,
            'type',
            'attribute',
        ]);

        //$params['attribute'] = json_decode($params['attribute'],true);
        $log = UserEventLog::create($params);
        return $this->success($log);
    }
}
