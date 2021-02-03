<?php


namespace App\Services;

use App\Models\Products;
use App\Support\ScrappedData;
use App\Support\ScrappedList;
use Goutte\Client;
use Illuminate\Support\Str;
use Symfony\Component\HttpClient\HttpClient;

class TrendyolService
{
    protected static $seller_id=Products::TRENDYOL;
    /**
     * Make a call to to specified url and return formatted data
     *
     * @param string $url
     *
     * @return array
     */
    public function scrap(string $url)
    {
        $client  = new Client(HttpClient::create(['timeout' => 120]));
        $crawler = $client->request('GET', $url);

        return $this->getData($crawler,$url);
    }

    private function getData($crawler,$link)
    {
        $contains = Str::contains($link, 'https://www.trendyol.com/erkek-spor-ayakkabi-x-g2-c109');
        if($contains)
        {
            $names = $crawler->filter('.prdct-desc-cntnr .prdct-desc-cntnr-ttl-w.two-line-text')->each(function ($node) {
                return $node->html();
            });

            $currency="TL";
            $prices = $crawler->filter('.prdct-desc-cntnr-wrppr .prc-cntnr')->each(function ($node) {
                $split=explode(" ",$node->filter('.prc-box-sllng')->text());
                $price=$split[0];
                $price=str_replace(',','.',$price);
                return $price;
            });


            if(!empty($names))
            {
                $data=(new ScrappedList());
                foreach ($names as $key => $name) {
                    $tempData = (new ScrappedData)
                        ->setSeller(self::$seller_id)
                        ->setName($name)
                        ->setPrice($prices[$key])
                        ->setCurrency($currency)
                        ->setService(__CLASS__);

                    $data->addData($tempData);
                }

                return $data->getData();
            }
            else
            {
                return [];
            }
        }
        else
        {
            if($crawler->count())
            {
                $data=(new ScrappedList());

                $name = $crawler->filter('.prdct-desc-cntnr .prdct-desc-cntnr-ttl-w two-line-text')->html();

                $prices = $crawler->filter('.prdct-desc-cntnr-wrppr .prc-cntnr .prc-box-sllng')->text();

                $price=explode(' ',$prices)[0];

                $currency="TL";

                $tempData = (new ScrappedData)
                    ->setSeller(self::$seller_id)
                    ->setName($name)
                    ->setPrice($price)
                    ->setCurrency($currency)
                    ->setService(__CLASS__);

                $data->addData($tempData);

                return $data->getData();
            }
            else
            {
                return [];
            }
        }
    }
}
