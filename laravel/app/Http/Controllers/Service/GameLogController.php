<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Services\System\AccessLogService;
use Services\Mongo\UserEventLog;

class GameLogController extends ApiController{

    
    public function testMongo(){
        $test = [
            'user_id' => '111',
            'role_id' => '1111',
            'dev_id' => '111',
            'type' => '1',
            'attribute' => [
                'fff'=>"fff"
            ]
        ];

        $log = UserEventLog::create($test);
        return $this->success($log);
    }
}
