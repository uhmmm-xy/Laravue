<?php

namespace Services\Mongo;

use App\Models\Game\UserModel;
use App\Models\Game\RoleModel;
class UserEventLog extends BaseModel
{

    /**@var ONLINE 在线人数 */
    public const ONLINE = "online_log";
    /**@var RECHARGE 充值日志  */
    public const RECHARGE = "recharge_log";
    /**@var RECHARGE 账号注册  */
    public const REGISTER = "account_reg_log";
    /**@var ROLE_CREATE 创建角色  */
    public const ROLE_CREATE = "role_create_log";
    /**@var LOGIN 登录登出  */
    public const LOGIN = "role_act_log";
    /**@var USER_CHANGE 用户基础信息变化 */
    public const USER_CHANGE = "user_change_log";


    protected $collection = 'user_event_log';

    protected $fillable = [
        'user_id',
        'role_id',
        'dev',
        'log_time',
        'type',
        'src_server_id',
        'server_id',
        'attribute',
    ];

    public function getDna(){
        return collect($this->attribute);
    }

    public function getUser(){
        return UserModel::where('union_id',$this->user_id)->first();
    }

    public function getRole(){
        return RoleModel::where('role_id',$this->user_id)->first();
    }

}
