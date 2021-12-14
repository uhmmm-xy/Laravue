<?php
namespace App\Services\Game;

use App\Services\Service;
use App\Models\Game\MapModel;
use Illuminate\Support\Facades\DB;
use Services\Facades\Games;
use Illuminate\Http\Response;
use Services\Classes\CosClient;

class MapService extends Service
{


    protected $model;

    public function __construct(MapModel $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    /**
     * 获取全部区服
     *
     * @return array
     */
    public function getMapList(){
        
        $list = Games::getLunhuiMap();
        foreach($list as $val){
            MapModel::updateOrCreate($val);
        }
        return $this->success(Response::HTTP_OK,'请求成功',$this->model->orderBy('map_id','asc')->get());
    }
}