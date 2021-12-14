<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $statusText 
 */
class ServerModel extends Model
{
    use HasFactory;
    protected $table = "game_server";
    protected $primaryKey = "index";

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $hidden = [''];

    const STATUS = [
        'no_open'   => 0,
        'open'      => 1,
        'recommend' => 2,
        'hot'       => 3
    ];

    protected $fillable = [
        'index', 'addr', 'name', 'port', 'notice_json', 'status', 'open_time', 'node_name',  'des_id', 'verify'
    ];

    protected $casts = [];

    const STATUS_CN = [
        0 => '未开服',
        1 => '开服',
        2 => '推荐',
        3 => '火爆'
    ];

    protected $appends = ['status_text'];

    public function getStatusTextAttribute()
    {
        return self::STATUS_CN[$this->status];
    }
}
