<?php
declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\ValueObject\Sku;

class Product
{
    private Sku $sku;
    private string $name;
    private string $description;
    private PriceCollection $prices;

    public function __construct(Sku $sku, string $name, string $description, ?PriceCollection $prices = null)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->description = $description;
        $this->prices = $prices ?? new PriceCollection();
    }

    public function sku(): Sku
    {
        return $this->sku;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function prices(): PriceCollection
    {
        return $this->prices;
    }
}
