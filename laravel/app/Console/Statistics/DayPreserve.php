<?php

namespace App\Console\Commands\Statistics;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\Stats\DayPreserve as DayPreserveModel;

/**
 * 用户留存统计
 */
class DayPreserve extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'day:preserve {day?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Statistics day user preserve';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $day = $this->argument('day');
        $day = is_null($day) ? Carbon::yesterday() : Carbon::parse($day);

        DayPreserveModel::statistics($day);
    }
}
