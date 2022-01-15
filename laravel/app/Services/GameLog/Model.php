<?php

namespace Services\GameLog;

class Model
{
    public $date_time;
    public $topic;
    public $trigger_time;
    public $device;
    public $src_zone_id;
    public $zone_id;
    public $channel_id;
    public $account_id;
    public $uid;

    protected $attr = [
        'date_time',
        'topic',
        'trigger_time',
        'device',
        'src_zone_id',
        'zone_id',
        'channel_id',
        'account_id',
        'uid',
    ];

    protected $append_attr = [];

    private $array;

    public function __construct(array $array)
    {
        $this->array = $array;
        collect($this->attr,$this->append_attr);
        foreach ($this->attr as $index => $value) {
            $this->{$value} = $array[$index];
        }
    }

}
