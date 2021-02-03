<?php

namespace App\Console\Commands;

use App\Jobs\ScrapDataJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ScrapperCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrap data from website.';


    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        ScrapDataJob::dispatch("");
        $this->info('Successfully scrapped');
        Artisan::call('queue:work --tries=3 --timeout=300');
    }
}
