<?php
namespace App\Services\Game;

use App\Services\Service;
use App\Models\Game\NoticeModel;
use Illuminate\Support\Facades\DB;
use Services\Facades\Games;
use Illuminate\Http\Response;
use Services\Classes\CosClient;

class NoticeService extends Service
{


    protected $model;

    public function __construct(NoticeModel $model)
    {
        parent::__construct();
        $this->model = $model;
    }
}