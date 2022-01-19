<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Services\Mongo\UserEventLog;
use Services\Repository\ServerService;
use Services\Repository\UserService;

class GameLogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    private $gameLog;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UserEventLog $userEventLog)
    {
        $this->gameLog = $userEventLog;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \DB::transaction(function () {

            //根据日志类型处理
            switch ($this->gameLog->type) {

                case UserEventLog::ONLINE:
                    //服务器统计
                    (new ServerService($this->gameLog))->run();
                    break;
                case UserEventLog::REGISTER:
                case UserEventLog::LOGIN:
                case UserEventLog::RECHARGE:
                case UserEventLog::ROLE_CREATE:
                case UserEventLog::USER_CHANGE:
                    //用户统计
                    (new UserService($this->gameLog))->run();
                    break;
            }
        });
    }
}
