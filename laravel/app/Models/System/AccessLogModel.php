<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\System\AccessLogModel
 *
 * @property int $id
 * @property \datetime|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $ip 请求ip
 * @property string|null $method 请求方法
 * @property string|null $path 请求路径
 * @property int|null $status 请求状态
 * @property float|null $latency 延迟（用时）
 * @property string|null $agent 代理
 * @property string|null $error_message 错误信息
 * @property string|null $body 请求Body
 * @property array|null $resp 响应Body
 * @property string|null $user_id 用户id
 * @property string|null $user_name 用户姓名
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLogModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLogModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLogModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLogModel whereAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLogModel whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLogModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLogModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLogModel whereErrorMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLogModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLogModel whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLogModel whereLatency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLogModel whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLogModel wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLogModel whereResp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLogModel whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLogModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLogModel whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessLogModel whereUserName($value)
 * @mixin \Eloquent
 */
class AccessLogModel extends Model
{
    use HasFactory;

    protected $table = 'sys_access_log';
    protected $primaryKey = "id";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        "id", "created_at", "updated_at", "deleted_at", "ip", "method", "path", "status",
        "latency", "agent", "error_message", "body", "resp", "user_id", "user_name"
    ];

    protected $casts = [
        'resp' => 'array',
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];
}
