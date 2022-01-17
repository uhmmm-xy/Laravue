<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Stats\OnlineDay;
use App\Models\Stats\StatsDay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Services\Mongo\OnlineLog;

class StatisticsController extends Controller
{

    public function getOnline(Request $request)
    {
        $startTime = Carbon::createFromTimeString($request->get("startTime"));
        $endTime   = Carbon::createFromTimeString($request->get("endTime"));
        $server_id = $request->get("serverId", false);

        $data      = OnlineLog::getOnLine($startTime, $endTime, $server_id);

        return $this->success($data);
    }

    public function getOnlineTime(Request $request)
    {
        $startTime = Carbon::createFromTimeString($request->get("startTime"));
        $endTime   = Carbon::createFromTimeString($request->get("endTime"));
        $server_id = $request->get("serverId", false);

        $result = OnlineDay::whereBetween('created_at',[$startTime,$endTime]);

        if($server_id){
            $result = $result->where('zone_id',$server_id);
        }

        return $this->success($result->get());
    }

    public  function getStatisDay(Request $request)
    {
        $startTime = Carbon::parse($request->get("startTime"));
        $endTime   = Carbon::parse($request->get("endTime"));

        $result = StatsDay::whereBetween('created_at',[$startTime,$endTime]);

        return $this->success($result->get());
    }

    public function getDayPreserve(Request $request)
    {
        $startTime = Carbon::parse($request->get("startTime"));
        $endTime   = Carbon::parse($request->get("endTime"));

        $result = OnlineDay::whereBetween('created_at',[$startTime,$endTime]);

        return $this->success($result->get());
    }

    public function getPayRank(Request $request)
    {
    }

    public function getLTVData(Request $request)
    {
    }
}
