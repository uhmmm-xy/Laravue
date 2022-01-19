<?php

namespace Services\Repository;

use Carbon\Carbon;
use Services\Mongo\UserEventLog;

class Service {


    protected $log;

    protected $action = [];

    protected $date,$day;

    public function __construct(UserEventLog $log)
    {
        $this->log = $log;
        $this->date = Carbon::parse($this->log->getDna()->get('date_time'));
        $this->day = $this->date->format("Ymd");
        loadLibrary("common");
    }

    public function run(){
        array_key_exists($this->log->type,$this->action) && $this->action && $this->{$this->action[$this->log->type]}();
    }

}