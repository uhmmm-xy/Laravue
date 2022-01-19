<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Services\Mongo\UserEventLog;

/**
 * @property string $statusText 
 */
class RoleModel extends Model
{
    use HasFactory;
    protected $table = "game_role";

    const NONE  = 0;
    const WHITE = 1;
    const BLACK = 2;
    const BAN   = 3;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $hidden = [''];

    protected $fillable = [
        'role_id',
        'role_name',
        'ser_id',
        'user_id',
        'status',
        'vip',
        'level',
        'gold',
        'jewel',
        'consume_gold',
        'consume_jewel',
        'exp',
    ];

    public function log(UserEventLog $log)
    {
        $this->role_name = $log->getDna()->get('nick');
        $this->vip = $log->getDna()->get('vip');
        $this->level = $log->getDna()->get('level');
        $this->status = $log->getDna()->get('status');
        $this->exp = $log->getDna()->only(['reborn','power','level']);

        $this->save();
        
    }

    protected $cats = [
        "exp" => "array"
    ];

}
