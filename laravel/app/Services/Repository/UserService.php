<?php

namespace Services\Repository;

use App\Models\Game\OrderModel;
use App\Models\Game\RoleModel;
use App\Models\Game\UserModel;
use App\Models\Stats\OnlineDay;
use App\Models\Stats\StatsDay;
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
            'last_login_time' => $this->date,
            'last_login_role' => $this->log->getDna()->get('uid'),
            'last_login_ser'  => $this->log->getDna()->get('zone_id'),
        ];
        $user = UserModel::create($attr);

        $user->created_at = $this->date;
        $user->save();
        safeIncrement(StatsDay::getDay($this->date->format('Ymd')), 'register_count');
        safeIncrement(StatsDay::getDay($this->date->format('Ymd')), 'active_count');
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

        if ($this->log->getDna()->get('operation_code') == 0) {

            //上次登录时间不是今天，则日活+1
            if (!$user->last_login_time->is($this->date->format('Y-m-d'))) {

                safeIncrement(StatsDay::getDay($this->day), 'active_count');

                safeIncrement(OnlineDay::getDay($this->log->server_id, $this->day), 'player_count');
            }


            safeIncrement(OnlineDay::getDay($this->log->server_id, $this->day), 'login_count');

            $user->login($this->log);
        } else {
            //记录在线时常
            OnlineDay::getDay($this->log->server_id, $this->day)->log((int)$this->log->getDna()->get('online_time'));
        }
    }

    /**
     * 充值事件
     *
     * @return void
     */
    public function recharge()
    {
        if ($this->log->getDna()->get('cost_type') != 3) {
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
            'exp' => $this->log->getDna()->only(['good_list', 'cost_type']),
        ];

        $order = OrderModel::create($order);
        $order->created_at = $this->date;
        $order->save();

        $user->last_recharge = $order->amount;
        $user->last_recharge_date = $order->created_at;

        safeIncrement($user,'total_recharge',$order->amount);

        if ($user->first_recharge == 0) {
            safeIncrement(StatsDay::getDay($this->day), 'new_pay_count');
            safeIncrement(StatsDay::getDay($this->day), 'new_pay_total', $order->amount);
            $user->first_recharge = $order->amount;
            $user->first_recharge_date = $order->created_at;
        }

        if($user->created_at->is($this->date->format('Y-m-d'))){
            safeIncrement(StatsDay::getDay($this->day), 'register_pay_count');
            safeIncrement(StatsDay::getDay($this->day), 'register_pay_total', $order->amount);
        }


        safeIncrement(StatsDay::getDay($this->day), 'pay_count');
        safeIncrement(StatsDay::getDay($this->day), 'pay_total', $order->amount);
        $user->save();
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

        $role = RoleModel::create($attr);
        safeIncrement($user, 'role_count');
        $role->created_at = $this->date;
        $role->save();
        safeIncrement(StatsDay::getDay($this->date->format('Ymd')), 'role_count');
    }

    public function userChange()
    {
        $role = $this->log->getRole();
        $role->log($this->log);
    }
}
