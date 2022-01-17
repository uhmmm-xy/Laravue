<?php

namespace Services\Repository;

use Services\Mongo\UserEventLog;

class Service {


    protected $log;

    protected $action = [];

    public function __construct(UserEventLog $log)
    {
        $this->log = $log;
        loadLibrary("common");
    }

    public function run(){
        array_key_exists($this->log->type,$this->action) && $this->action && $this->{$this->action[$this->log->type]}();
    }

}