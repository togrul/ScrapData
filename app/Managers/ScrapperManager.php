<?php


namespace App\Managers;


class ScrapperManager
{
    protected array $services;

    public function __construct(array $services)
    {
        $this->services = $services;
    }

    public function scrap(): array
    {
        $results = [];

        foreach($this->services as $service => $url)
        {
            //return ScrappedData from function scrap
            $results=array_merge($results,resolve($service)->scrap($url));
        }
        return $results;
    }
}
