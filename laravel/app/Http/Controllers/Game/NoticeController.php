<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Services\Game\NoticeService;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    protected $server;

    public function __construct(NoticeService $server)
    {
        $this->server = $server;
    }

}
