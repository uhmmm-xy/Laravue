<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Services\Game\MailService;
use Illuminate\Http\Request;

class MailController extends Controller
{
    protected $server;

    public function __construct(MailService $server)
    {
        $this->server = $server;
    }

    public function sendZoneMail(Request $request){
        $data = $request->all();
        $ret = $this->server->sendZoneMail($data);

        return $this->responseJson($ret);
    }

    public function sendMail(Request $request){
        $data = $request->all();
        $ret = $this->server->sendMail($data);

        return $this->responseJson($ret);
    }
}
