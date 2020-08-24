<?php
declare(strict_types=1);

namespace App\Application\Command;

use App\Domain\Model\Price;
use App\Domain\ValueObject\Sku;

class PriceCommand
{
    private string $sku;
    private int $price;
    private string $currency;
    private string $unit;

    public function __construct(string $sku, int $price, string $currency, string $unit)
    {
        $this->sku = $sku;
        $this->price = $price;
        $this->currency = $currency;
        $this->unit = $unit;
    }

    public function sku(): Sku
    {
        return new Sku($this->sku);
    }

    public function toModel(): Price
    {
        return new Price($this->price, $this->unit, $this->currency);
    }
}
