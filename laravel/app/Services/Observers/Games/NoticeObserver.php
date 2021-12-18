<?php

namespace Services\Observers\Games;

use App\Models\Game\NoticeModel;
use PHPUnit\Framework\Error\Notice;
use Services\Classes\CosClient;


class NoticeObserver
{

    protected function uploadJson(NoticeModel $model)
    {

        $json = [
            'timestamp' => $model->timestamp,
            'content'   => $model->content
        ];
        $jsonStr = json_encode($json);
        $model->json_url = (new CosClient())->upLoadJson($jsonStr, NoticeModel::FILENAME . '_' . $model->timestamp . NoticeModel::FILETYPE);
        $model->save();
    }

    public function created(NoticeModel $model){
        $this->uploadJson($model);
    }

    public function updated(NoticeModel $model){
        $this->uploadJson($model);
    }

    public function deleting(NoticeModel $model){
        $cosClient = new CosClient();
        $name = $cosClient->dir.NoticeModel::FILENAME.'_'.$model->timestamp.NoticeModel::FILETYPE;
        $cosClient->deleteObj($name);
    }

}