<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Services\Game\NodeService;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    protected $server;

    public function __construct(NodeService $server)
    {
        $this->server = $server;
    }

    public function getNodeList(Request $request){
        $ret = $this->server->getNodeList();
        return $this->responseJson($ret);
    }

}
