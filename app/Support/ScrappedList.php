<?php


namespace App\Support;


class ScrappedList
{
    protected array $data;

    public function addData(ScrappedData $scrappedData)
    {
        $this->data[]=$scrappedData;
    }

    public function getData()
    {
        return $this->data;
    }
}
