<?php


namespace App\Support;


class ScrappedData
{
    protected ?string $seller;
    protected ?string $name;
    protected ?string $price;
    protected ?string $currency;
    protected ?string $service;

    public function setSeller(?string $seller): ScrappedData
    {
        $this->seller = $seller;

        return $this;
    }

    public function getSeller(): ?string
    {
        return $this->seller;
    }

    public function setName(?string $name): ScrappedData
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setPrice(?string $price): ScrappedData
    {
        $this->price = $price;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setCurrency(?string $currency): ScrappedData
    {
        $this->currency= $currency;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setService(?string $service): ScrappedData
    {
        $this->service = $service;

        return $this;
    }

    public function getService(): ?string
    {
        return $this->service;
    }
}
