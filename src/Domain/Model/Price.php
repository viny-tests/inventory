<?php
declare(strict_types=1);

namespace App\Domain\Model;

class Price
{
    private int $price;
    private string $unit;
    private string $currency;

    public function __construct(int $price, string $unit, string $currency)
    {
        $this->price = $price;
        $this->unit = $unit;
        $this->currency = $currency;
    }

    public function price(): int
    {
        return $this->price;
    }

    public function unit(): string
    {
        return $this->unit;
    }

    public function currency(): string
    {
        return $this->currency;
    }
}
