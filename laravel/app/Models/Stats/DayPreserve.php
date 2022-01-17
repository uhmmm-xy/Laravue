<?php

namespace App\Models\Stats;

use App\Models\Game\UserModel;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Services\Mongo\LoginLog;

/**
 * 用户留存
 * 自然日：包括1天后、2天后、3天后、4天后、5天后、6天后、7天后、14天后和30天后
 * 自然周：包括1周后、2周后、3周后、4周后、5周后、6周后、7周后、8周后、9周后
 * 自然月：包括1月后、2月后、3月后、4月后、5月后、6月后、7月后、8月后、9月后
 * 
 * 日留存率计算方式：假设某 App 在1月3日的新增用户有100个，这100个用户在1月4日中启动应用的有55个，在1月5日中启动应用的有45个，在1月6日启动应用的有30个，则1月3日的新增用户在1天后留存是55/100=55%，2天后留存是45/100=45%，3天后留存是30/100=30%，4-7天后，14天后和30天后同理，依次类推。
 * 周留存率计算方式：假设3月的第1周某APP的新增用户有200个，这200个用户在3月的第2周中有100个再次启动了应用（无启动次数限制），3月的第3周中有80个再次启动应用，3月的第4周中有50个再次启动应用，则3月第1周的新增用户在1周后（即第2周）的留存率是100/200=50%，在2周后的留存率是80/200=40%，在3周后的留存率是50/200=25%。4周后到9周后的留存同理，依次类推。
 * 月留存率计算方式：假设某 App 5月份新增用户有1000个，这1000人在6月份启动过应用的有600人，7月份启动过应用的有450人，8月份启动过应用的有300人，则5月的新增用户在一个月后的留存率是600/1000=60%，二个月后的留存率是450/1000=45%，三个月后的留存率是300/1000=30%。4月后到9月后的留存同理，依次类推。
 * 
 */
class DayPreserve extends Model
{
    protected $table = 'day_preserve';
    protected $fillable = [
        'id', 'register', 'stats', 
    ];
    
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'stats' => 'object',
    ];

    /**
     * 用户留存(s)
     */
    const days = [
        1, 3, 4, 5, 6, 7, 15, 30, 60, 180
    ];

    /**
     * 统计留存
     * @param Carbon $day
     * @return void
     */
    public static function statistics(Carbon $day)
    {
        $id = $day->format('Ymd');
        
        /** @var static $preserve */
        $preserve = self::firstOrCreate(compact('id'));

        //登录的用户
        $logins = self::getLoginUsers($day);

        $object = [];
        foreach (self::days as $val) {
            $users = self::getBeforeRegister($day, $val);
            
            $object[$val] = [
                'register' => count($users),
                'login'    => count(array_intersect($logins, $users)),
            ];
        }

        $preserve->register = self::getRegister($day)->count();
        $preserve->stats = $object;
        $preserve->saveOrFail();
    }

    /**
     * 获取某一天的用户注册
     * @param Carbon $day
     * @return static
     */
    public static function getRegister(Carbon $day)
    {
        $startTime = (clone $day)->startOfDay();
        $endTime   = (clone $day)->endOfDay();
        return UserModel::whereBetween('created_at', [$startTime, $endTime]);
    }

    /**
     * 获取某一天登录的用户
     * @param Carbon $day
     */
    public static function getLoginUsers(Carbon $day)
    {
        $startTime = (clone $day)->startOfDay();
        $endTime   = (clone $day)->endOfDay();
        return LoginLog::getLoginUsers($startTime, $endTime)->pluck('user_id')->toArray();
    }

    /**
     * 获取某一天的前x天用户注册
     * @param Carbon $day
     * @param integer $pre
     * @return array
     */
    public static function getBeforeRegister(Carbon $day, int $pre)
    {
        return UserModel::whereBetween('created_at', [
            (clone $day)->subDay($pre)->startOfDay(),
            (clone $day)->subDay($pre)->endOfDay(),
        ])->pluck('id')->toArray();
    }

}
