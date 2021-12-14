<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Game\MailModel
 *
 * @property int $id
 * @property string|null $title 标题
 * @property string|null $content 内容
 * @property int|null $type 类型
 * @property string|null $send_to 收件人
 * @property int|null $status 状态
 * @property string|null $attch 包含道具
 * @property int|null $zone_id 服务器id
 * @property string|null $valid_day 生效时间
 * @property int|null $all_user 是否发送所有人
 * @property string|null $nodename 节点名
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|MailModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MailModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MailModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|MailModel whereAllUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailModel whereAttch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailModel whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailModel whereNodename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailModel whereSendTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailModel whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailModel whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailModel whereValidDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailModel whereZoneId($value)
 * @mixin \Eloquent
 */
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
