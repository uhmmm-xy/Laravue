<?php
namespace Services\Mongo;

use Illuminate\Support\Carbon;

/**
 * 用户登录日志
 */
class LoginLog extends BaseModel
{
    protected $collection = 'user_logs';                //文档名    
    protected $fillable = [
        'user_id',
        'device_id',
        'ip',
    ];

    const SORT = [
        'asc'   =>   1,  //升序
        'desc'  =>  -1  //降序
    ];

    /**
     * 获取区间内登录用户
     * @param Carbon $startTime
     * @param Carbon $endTime
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getLoginUsers(Carbon $startTime, Carbon $endTime)
    {
        $startTime = mongoDateTime($startTime);
        $endTime   = mongoDateTime($endTime);
        
        return self::raw(function ($collection) use ($startTime, $endTime) {
            $match = [
                'created_at' => ['$gt' => $startTime, '$lt' => $endTime]
            ];
            return $collection->aggregate([
                ['$match' => $match],
                ['$group' => [
                    '_id' => '$user_id',
                    'user_id' => ['$first' => '$user_id'],
                ]],
            ]);
        });
    }


    /**
     * 获取活跃玩家数
     *
     * @param Carbon $beginTime
     * @param Carbon $endTime
     * @param Array $players
     * @return \Illuminate\Support\Collection|\Illuminate\Database\Query\Expression
     */
    public static function getActivePlayer(Carbon $beginTime,Carbon $endTime,Array $players)
    {


        $start_time   =   mongoDateTime($beginTime->startOfDay());
        $end_time     =   mongoDateTime($endTime->endOfDay());

        return self::raw(function ($collection) use ($start_time, $end_time, $players) {
            $arrayQuery = [
                ['$match'                => [
                    'created_at'        => ['$gt' => $start_time, '$lt' => $end_time],
                    'user_id'         => ['$in' => $players]
                ]],
                ['$group'              => [
                    "_id"  => [
                        'user_id' => '$user_id',
                        'loginDate' => ['$dateToString' => [
                            'format' => '%Y-%m-%d',
                            'date' => '$created_at',
                        ]],
                    ]
                ]],
                [
                    '$sort' => [
                        '_id.loginDate' => self::SORT['desc']
                    ]
                ],
                [
                    '$group' => [
                        "_id" => "",
                        "beginDate" => ['$first' => '$_id.loginDate'],
                        "endDate" => ['$last' => '$_id.loginDate'],
                        "activeCount" => ['$sum' => 1],
                    ]
                ]
            ];


            return $collection->aggregate($arrayQuery);
        });
    }
}
