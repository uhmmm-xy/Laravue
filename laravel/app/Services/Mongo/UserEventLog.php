<?php

namespace Services\Mongo;

class UserEventLog extends BaseModel
{

    protected $collection = 'user_event_log';

    protected $fillable = [
        'user_id',
        'role_id',
        'dev_id',
        'type',
        'attribute',
    ];

}
