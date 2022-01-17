<?php

namespace App\Models\Stats;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * 充值活跃统计相关
 */
class StatsDay extends Model
{
    protected $table    = 'stats_day';
    protected $fillable = [
        'date',
        'register_count',
        'active_count',
        'pay_count',
        'pay_total',
        'new_pay_count',
        'new_pay_total',
    ];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'date';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;



    const ATTRIBUTES = [
        'date'           => '日期',
        'register_count' => '注册数',
        'active_count'   => '活跃数',
        'pay_count'      => '充值人数',
        'pay_total'      => '充值金额',
        'new_pay_count'  => '新增充值人数',
        'new_pay_total'  => '新增充值金额',
    ];

    /**
     * 平台每日数据
     * @return static|\Illuminate\Database\Eloquent\Model
     */
    static function getToDay()
    {
        $date = Carbon::today()->format('Ymd');
        return self::firstOrCreate(compact('date'));
    }
}
