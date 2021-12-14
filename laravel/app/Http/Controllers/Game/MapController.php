<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Services\Game\MapService;
use Illuminate\Http\Request;

class MapController extends Controller
{
    protected $server;

    public function __construct(MapService $server)
    {
        $this->server = $server;
    }

    public function getMapList(Request $request){
        $ret = $this->server->getMapList();
        return $this->responseJson($ret);
    }

}
