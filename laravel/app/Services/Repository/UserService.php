<?php

namespace Services\Repository;

use App\Models\Game\OrderModel;
use App\Models\Game\RoleModel;
use App\Models\Game\UserModel;
use App\Models\Stats\OnlineDay;
use App\Models\Stats\StatsDay;
use Carbon\Carbon;
use Services\Mongo\UserEventLog;

class UserService extends Service
{

    protected $action = [
        UserEventLog::REGISTER    => "register",
        UserEventLog::LOGIN       => "login",
        UserEventLog::RECHARGE    => "recharge",
        UserEventLog::ROLE_CREATE => "roleCreate",
        UserEventLog::USER_CHANGE => "userChange",
    ];

    /**
     * 注册事件
     *
     * @return void
     */
    protected function register()
    {
        $attr = [
            'user_name'       => $this->log->getDna()->get('user_account'),
            'open_id'         => $this->log->getDna()->get('channel_id'),
            'union_id'        => $this->log->getDna()->get('account_id'),
            'device_num'      => $this->log->getDna()->get('device_id'),
            'last_login_ip'   => $this->log->getDna()->get('ip'),
            'channel'         => $this->log->getDna()->get('acc_type'),
            'password'        => $this->log->getDna()->get('psw'),
            'last_login_time' => Carbon::now(),
            'last_login_role' => $this->log->getDna()->get('uid'),
            'last_login_ser'  => $this->log->getDna()->get('zone_id'),
        ];
        UserModel::create($attr);

        safeIncrement(StatsDay::getToDay(),'register_count');

    }

    /**
     * 登录登出
     *
     * @return void
     */
    protected function login()
    {
        /**@var UserModel $user */
        $user = $this->log->getUser();

        if($this->log->getDna()->get('operation_code')==0){

            //上次登录时间不是今天，则日活+1
            if(!$user->last_login_time->isToday()){

                safeIncrement(StatsDay::getToDay(),'active_count');

                safeIncrement(OnlineDay::getToDay(),'player_count');

            }

            safeIncrement(OnlineDay::getToDay(),'login_count');

            $user->login($this->log);

        }else{
            //记录在线时常
            OnlineDay::getToDay()->log($this->log->getDna()->get('online_time'));
        }
    }

    /**
     * 充值事件
     *
     * @return void
     */
    public function recharge()
    {
        if($this->log->getDna()->get('cost_type') != 3){
            return;
        }
        $user = $this->log->getUser();
        $role = $this->log->getRole();

        $order = [
            'shop_id' => $this->log->getDna()->get('recharge_id'),
            'amount' => $this->log->getDna()->get('pay_money'),
            'channel_id' => $this->log->getDna()->get('pay_type'),
            'channel_order_id' => $this->log->getDna()->get('sdk_order_id'),
            'order_id' => $this->log->getDna()->get('order_id'),
            'user_id' => $user->id,
            'server_id' => $this->log->getDna()->get('zone_id'),
            'role_id' => $role->id,
            'status' => $this->log->getDna()->get('status'),
            'exp' => $this->log->getDna()->only(['good_list','cost_type']),
        ];

        $order = OrderModel::create($order);



    }

    /**
     * 角色创建
     *
     * @return void
     */
    public function roleCreate()
    {
        $user = $this->log->getUser();

        $attr = [
            'role_id' => $this->log->role_id,
            'role_name' => $this->log->getDna()->get('nick'),
            'ser_id' => $this->log->getDna()->get('zone_id'),
            'user_id' => $user->id,
            'status' => RoleModel::NONE,
        ];

        RoleModel::create($attr);
        safeIncrement($user,'role_count');
        safeIncrement(StatsDay::getToDay(),'role_count');
    }

    public function userChange(){

        $role = $this->log->getRole();
        $role->log($this->log);

    }
}
