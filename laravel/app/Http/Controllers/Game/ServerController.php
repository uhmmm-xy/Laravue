<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Services\Game\ServerService;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    protected $server;

    public function __construct(ServerService $server)
    {
        $this->server = $server;
    }

    public function getZoneList(Request $request){
        $ret = $this->server->getZoneList();
        return $this->responseJson($ret);
    }

}
