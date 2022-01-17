<?php

namespace Services\Repository;

use Services\Mongo\UserEventLog;
use Services\Mongo\OnlineLog;

class ServerService extends Service{

    protected $action = [
        UserEventLog::ONLINE => "onLineLog"
    ];

    protected function onLineLog(){
        $attr = collect($this->log->attribute);
        $config = config("gameLog.".$this->log->type);
        OnlineLog::create($attr->only($config)->toArray());
    }
}