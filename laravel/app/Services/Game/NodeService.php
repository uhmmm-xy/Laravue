<?php
namespace App\Services\Game;

use App\Services\Service;
use App\Models\Game\NodeModel;
use Illuminate\Support\Facades\DB;
use Services\Facades\Games;
use Illuminate\Http\Response;
use Services\Classes\CosClient;

class NodeService extends Service
{


    protected $model;

    public function __construct(NodeModel $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    /**
     * 获取全部节点
     *
     * @return array
     */
    public function getNodeList(){
        
        $list = Games::getAllNode();
        foreach($list as $val){
            NodeModel::updateOrCreate($val);
        }
        return $this->success(Response::HTTP_OK,'请求成功',$this->model->orderBy('id','asc')->get());
    }
}