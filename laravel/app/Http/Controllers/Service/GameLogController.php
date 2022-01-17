<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\ApiController;
use App\Jobs\GameLogJob;
use Illuminate\Http\Request;
use App\Services\System\AccessLogService;
use Services\GameLog\GameLog;
use Services\Mongo\UserEventLog;

class GameLogController extends ApiController{

    
    public function createGameLog(Request $request){

        $data = $request->get('data','');

        $gameLog = GameLog::decode($data);

        $log = UserEventLog::create($gameLog->getArray());
        GameLogJob::dispatch($log);
        return $this->success($log);
    }
}
