<?php


namespace App\Services;


use App\Models\Products;
use App\Support\ScrappedData;
use App\Support\ScrappedList;
use Goutte\Client;
use Illuminate\Support\Str;
use Symfony\Component\HttpClient\HttpClient;

class DefactoService
{
    protected static $seller_id=Products::DEFACTO;
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
        $contains = Str::contains($link, 'https://www.defacto.com.tr/erkek');

        if($contains)
        {
            $names = $crawler->filter('.product-info-title.text-ellipsis')->each(function ($node) {
                return $node->html();
            });


            $currency="TL";

            $prices = $crawler->filter('.product-info')->each(function ($node) {
                $split=explode(" ",$node->filter('.sale-price')->text());
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

                $name =$crawler->filter('.product-info-title text-ellipsis')->html();

                $prices =$crawler->filter('.product-info-price .sale-price')->text();

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
