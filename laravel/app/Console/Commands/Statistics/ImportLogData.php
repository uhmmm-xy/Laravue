<?php

namespace App\Console\Commands\Statistics;

use App\Jobs\GameLogJob;
use Arr;
use Carbon\Carbon;
use File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Log;
use Services\GameLog\GameLog;
use Services\Mongo\UserEventLog;

/**
 * 导入gameLog
 */
class ImportLogData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:gameLog {src?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import game log';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private $runTime;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $src = $this->argument('src');
        if($src){
            echo "not path! \r\n";
            return false;
        }
        $files = [];
        $this->runTime = time();
        $this->searchDir($src, $files);

        $actives = [
            UserEventLog::REGISTER    => [],
            UserEventLog::LOGIN       => [],
            UserEventLog::RECHARGE    => [],
            UserEventLog::ROLE_CREATE => [],
            UserEventLog::USER_CHANGE => [],
            UserEventLog::ONLINE      => [],
        ];

        Storage::put("log/{$this->runTime}_import.log", "[begin]");
        Storage::put("log/{$this->runTime}_error.log", "[error]");

        foreach ($files as $value) {
            foreach ($actives as $active => $fs) {
                if (Str::is("*" . $active . "*", $value)) {
                    array_push($actives[$active], $value);
                }
            }
        }


        $this->createLog($actives[UserEventLog::REGISTER]);
        $this->createLog($actives[UserEventLog::ROLE_CREATE]);
        $this->createLog($actives[UserEventLog::LOGIN]);
        $this->createLog($actives[UserEventLog::USER_CHANGE]);
        $this->createLog($actives[UserEventLog::ONLINE]);
        $this->createLog($actives[UserEventLog::RECHARGE]);
    }

    function searchDir($path, &$files)
    {

        if (is_dir($path)) {

            $opendir = opendir($path);

            while ($file = readdir($opendir)) {
                if ($file != '.' && $file != '..') {
                    $this->searchDir($path . '/' . $file, $files);
                }
            }
            closedir($opendir);
        }
        if (!is_dir($path)) {
            $files[] = $path;
        }
    }

    public function createLog(array $files)
    {
        $ok = 0;
        $wrong = 0;
        $id = 0;
        foreach ($files as $path) {
            $file = fopen($path, 'r');
            while ($line = fgets($file)) {
                ++$id;
                try {
                    $gameLog = GameLog::decode($line);

                    $log = UserEventLog::create($gameLog->getArray());
                    $log->created_at = Carbon::parse($log->getDna()->get('date_time'));
                    $log->save();
                    GameLogJob::dispatch($log);
                    ++$ok;
                } catch (\Throwable $th) {
                    ++$wrong;
                    Storage::append("log/{$this->runTime}_import.log", "[$id] $line" );
                    Storage::append("log/{$this->runTime}_error.log", "[$id] ".$th->getMessage() );
                }
            }
            fclose($file);
        }
        print_r("ok: $ok\r\n");
        print_r("wrong: $wrong\r\n");
    }
}
