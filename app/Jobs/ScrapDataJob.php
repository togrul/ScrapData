<?php

namespace App\Jobs;

use App\Managers\ScrapperManager;
use App\Models\Products;
use App\Services\DefactoService;
use App\Services\TrendyolService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScrapDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $page;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($page)
    {
        $this->page=$page;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(empty($this->page))
        {
            $scrapper = new ScrapperManager([
                TrendyolService::class => 'https://www.trendyol.com/erkek-spor-ayakkabi-x-g2-c109',
                DefactoService::class => 'https://www.defacto.com.tr/erkek',
            ]);
        }
        else
        {
            $scrapper = new ScrapperManager([
                TrendyolService::class => 'https://www.trendyol.com/erkek-spor-ayakkabi-x-g2-c109',
                DefactoService::class => sprintf("https://www.defacto.com.tr/erkek?page=%d", $this->page),
            ]);
        }

        foreach($scrapper->scrap() as $data) {
            // data --> ScrappedData olacaq.
            Products::firstOrCreate([
                'seller_id' => $data->getSeller(),
                'name' => $data->getName(),
            ], [
                'price' => $data->getPrice(),
                'currency'=>$data->getCurrency(),
                'is_completed'=>1
            ]);
        }
    }
}
