<?php

namespace App\Services\Game;

use App\Services\Service;
use App\Models\Game\MailModel;
use Illuminate\Support\Facades\DB;
use Services\Facades\Games;
use Symfony\Component\HttpFoundation\Response;

class MailService extends Service
{


    protected $model;

    public function __construct(MailModel $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    /**
     * 发送邮件
     *
     * @param array $data
     * @return array
     */
    public function sendMail($data){
        DB::beginTransaction();
        try {
            $data['type'] = MailModel::TYPE_USER;
            $result = $this->model->fill($data)->save();
            Games::sendMail($this->model->title,$this->model->content,$this->model->to_user,$this->model->attach);
            $result = $this->success(Response::HTTP_OK, '添加数据成功！', $result);
            DB::commit();
        } catch (\Exception $ex) { 
            DB::rollBack();
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }


    /**
     * 发送全服邮件
     *
     * @param array $data
     * @return array
     */
    public function sendZoneMail($data){
        DB::beginTransaction();
        try {
            $data['type'] = MailModel::TYPE_ZONE;
            $data['to_user'] = MailModel::USER_ALL;
            $result = $this->model->fill($data)->save();
            Games::sendZoneMail($this->model->title,$this->model->content,$this->model->zone,$this->model->attach,$this->model->validDay,$this->model->allUser,$this->model->nodelname);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }

}
