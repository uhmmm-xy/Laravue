<?php

namespace App\Services\Game;

use App\Services\Service;
use App\Models\Game\ServerModel;
use Illuminate\Support\Facades\DB;
use Services\Facades\Games;
use Illuminate\Http\Response;

class ServerService extends Service
{


    protected $model;

    public function __construct(ServerModel $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    /**
     * 获取全部区服
     *
     * @return array
     */
    public function getZoneList(){
        $jsonUrl = Games::getServerListURL();
        $content = file_get_contents($jsonUrl);
        $list = json_decode($content,true)['zones'];
        foreach($list as $k=>$v){
            $list[$k] = [
                'index'       => $v[0],
                'name'        => $v[1],
                'addr'        => $v[2],
                'port'        => $v[3],
                'status'      => $v[4],
                'notice_json' => $v[5],
                'open_time'   => $v[6],
            ];
            ServerModel::updateOrCreate($list[$k]);
        }
        return $this->success(Response::HTTP_OK,'请求成功',$this->model->orderBy('index','asc')->get());
    }
}