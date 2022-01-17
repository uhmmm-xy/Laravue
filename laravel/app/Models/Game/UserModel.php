<?php

namespace App\Models\Game;

use App\Models\Stats\StatsDay;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Services\Mongo\LoginLog;
use Services\Mongo\UserEventLog;

/**
 * @property string $statusText 
 */
class UserModel extends Model
{
    protected $table = "game_user";

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
        "user_name",
        "password",
        "union_id",
        "open_id",
        "channel",
        "phone",
        "email",
        "gender",
        "user_type",
        "gold",
        "jewel",
        "consume_gold",
        "consume_jewel",
        "total_recharge",
        "first_recharge",
        "first_recharge_date",
        "last_recharge",
        "last_recharge_date",
        "status",
        "role_count",
        "last_login_time",
        "last_login_ser",
        "last_login_role",
        "last_login_ip",
        "device_num"
    ];

    protected $casts = [
        "last_login_time"     => "datetime",
        "last_recharge_date"  => "datetime",
        "first_recharge_date" => "datetime",
    ];


    public function recharge(OrderModel $order)
    {

        safeIncrement($this, 'total_recharge', $order->amount);
        $this->last_recharge = $order->amount;
        $this->last_recharge_date = Carbon::now();
        safeIncrement(StatsDay::getToDay(),'pay_count');
        safeIncrement(StatsDay::getToDay(),'pay_total',$order->amount);

        if ($this->first_recharge == 0) {
            $this->first_recharge = $order->amount;
            $this->last_recharge_date = Carbon::now();
            safeIncrement(StatsDay::getToDay(),'new_pay_count');
            safeIncrement(StatsDay::getToDay(),'new_pay_total',$order->amount);
        }

    }

    public function login(UserEventLog $log){

        $this->last_login_time = Carbon::now();
        $this->last_login_role = $this->log->getDna()->get('uid');
        $this->last_login_ser = $this->log->getDna()->get('zone_id');
        $this->last_login_ip = $this->log->getDna()->get('ip');
        $this->device_num = $this->log->getDna()->get('device_id');

        $this->save();
        
        LoginLog::create([
            'user_id' => $this->id,
            'device_id' => $this->device_num,
            'ip' => $this->last_login_ip
        ]);
    }
}
