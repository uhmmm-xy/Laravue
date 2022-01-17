<?php

namespace App\Models\Stats;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * 充值活跃统计相关
 */
class OnlineDay extends Model
{
    protected $table    = 'online_day';
    protected $fillable = [
        'date',
        'zone_id',
        'player_count',
        'login_count',
        '1s_10s',
        '10s_60s',
        '60s_5m',
        '5m_10m',
        '10m_30m',
        '30m_1h',
        '1h_2h',
        '2h_so'
    ];


    /**
     * 每日数据
     * @return static|\Illuminate\Database\Eloquent\Model
     */
    static function getToDay($zone_id)
    {
        $date = Carbon::today()->format('Ymd');
        return self::firstOrCreate(compact('date','zone_id'));
    }

    public function log(int $time)
    {
        if ($time > 3600) {
            $h = division($time, 3600);
            if ($h > 2) {
                safeIncrement($this, '2h_so');
            } else {
                safeIncrement($this, '1h_2h');
            }
        } else if ($time > 60) {
            $m = division($time, 60);
            if ($m <= 5) {
                safeIncrement($this, '60s_5m');
            } else if ($m <= 10) {
                safeIncrement($this, '5m_10m');
            } else if ($m <= 30) {
                safeIncrement($this, '10m_30m');
            } else {
                safeIncrement($this, '30m_1h');
            }
        } else {
            if ($time <= 10) {
                safeIncrement($this, '1s_10s');
            }
            if ($time <= 60) {
                safeIncrement($this, '10s_60s');
            }
        }
    }
}
