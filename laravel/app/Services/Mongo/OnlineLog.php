<?php

namespace Services\Mongo;

use Illuminate\Support\Carbon;

class OnlineLog extends BaseModel
{


    protected $collection = 'online_log';

    protected $fillable = [
        "zone_id",
        "total_num",
        "ios_num",
        "android_num",
    ];

    /**
     * 获取区间在线人数
     *
     * @param Carbon $startTime
     * @param Carbon $endTime
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getOnLine(Carbon $startTime, Carbon $endTime, $zoneId = false)
    {


        $startTime = mongoDateTime($startTime);
        $endTime   = mongoDateTime($endTime);

        return self::raw(function ($collection) use ($startTime, $endTime, $zoneId) {

            $match = [
                'created_at' => ['$gt' => $startTime, '$lt' => $endTime]
            ];
            if ($zoneId) {
                $match['zone_id'] = $zoneId;
            }
            return $collection->aggregate([
                ['$match' => $match],
                ['$group' => [
                    '_id'         => '',
                    "zone_id"     => '$zone_id',
                    "total_num"   => '$total_num',
                    "ios_num"     => '$ios_num',
                    "android_num" => '$android_num',
                ]],
            ]);
        });
    }
}
