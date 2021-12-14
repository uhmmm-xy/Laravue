<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailModel extends Model
{
    use HasFactory;
    protected $table = "game_mail";
    protected $primaryKey = "id";

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    //全服邮件
    const TYPE_ZONE = 1;
    //指定用户邮件
    const TYPE_USER = 2;



    //全部玩家
    const USER_ALL = '0';

    protected $hidden = [''];

    protected $fillable = [
        'title', 'content', 'type', 'send_to', 'status', 'attach', 'zone_id', 'valid_day', 'all_user', 'nodename'
    ];

    protected $casts = [];
}
