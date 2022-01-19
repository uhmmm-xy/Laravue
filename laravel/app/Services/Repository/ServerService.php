<?php

namespace Services\Repository;

use Services\Mongo\UserEventLog;
use Services\Mongo\OnlineLog;

class ServerService extends Service{

    protected $action = [
        UserEventLog::ONLINE => "onLineLog"
    ];

    protected function onLineLog(){
        $config = config("gameLog.".$this->log->type);
        $onlineLog = OnlineLog::create($this->log->getDna()->only($config)->toArray());
        $onlineLog->created_at = $this->date;
        $onlineLog->save();
    }
}