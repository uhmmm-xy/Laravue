<?php
namespace Services\Mongo;

use Jenssegers\Mongodb\Eloquent\Model as MongoModel;
use Services\Traits\DateRange;

class BaseModel extends MongoModel
{
    use DateRange;

    protected $connection = 'mongodb';
    protected $primaryKey = '_id';
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['_id'];
}
