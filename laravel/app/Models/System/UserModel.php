<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\System\UserModel
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $uuid 用户UUID
 * @property string|null $username 用户登录名
 * @property string|null $password 用户登录密码
 * @property string|null $nick_name 用户昵称
 * @property string|null $header_img 用户头像
 * @property string|null $authority_id 用户角色ID
 * @property-read \App\Models\System\AuthorityModel|null $authority
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|UserModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserModel whereAuthorityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserModel whereHeaderImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserModel whereNickName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserModel wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserModel whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserModel whereUuid($value)
 * @mixin \Eloquent
 */
class UserModel extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    protected $table = "sys_users";
    protected $primaryKey = "id";
    protected $hidden = ['password'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        "id", "uuid", "username", "password", "nick_name", "header_img", "authority_id", "created_at", "updated_at"
    ];

    protected function setPasswordAttribute($value)
    {
        $this->attributes['password'] = md5($value);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // 关联角色表
    public function authority()
    {
        return $this->hasOne('App\Models\System\AuthorityModel','authority_id','authority_id');
    }
}
