<?php

namespace Services\GameLog;

class GameLog
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
    public $attribute;

    protected $base = [
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

    private $config;

    private $attr;

    private $json;

    public function __construct(array $array)
    {
        foreach ($this->base as $index => $value) {
            $this->{$value} = $array[$index];
        }
        $this->config = collect(config("gameLog." . $this->topic));

        $this->attr = collect([$this->base, $this->config])->collapse();

        $this->json = [
            "user_id" => $this->account_id,
            "role_id" => $this->uid,
            "dev" => $this->device,
            "type" => $this->topic,
            "log_time" => $this->trigger_time,
            "server_id" => $this->zone_id,
            "ser_server_id" => $this->src_zone_id
        ];

        foreach ($this->attr as $index => $value) {
            $this->json["attribute"][$value] = $array[$index];
        }
        return $this->json;
    }

    public static function decode(string $data)
    {
        $attr = explode('|', $data);
        return new GameLog($attr);
    }

    
    public function getCollect(){
        return collect($this->json);
    }

    public function getArray(){
        return $this->json;
    }


}
