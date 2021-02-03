<?php

namespace Tests\Unit;

use App\Managers\ScrapperManager;
use App\Services\DefactoService;
use App\Services\TrendyolService;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testGettingDataFromUrl()
    {
        $scrapper = new ScrapperManager([
            TrendyolService::class => 'https://www.trendyol.com/erkek-spor-ayakkabi-x-g2-c109',
            DefactoService::class => 'https://www.defacto.com.tr/erkek',
        ]);

        $response =$scrapper->scrap();

        $this->assertTrue(count($response)>0);
    }
}
