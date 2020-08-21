<?php
declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\ValueObject\Uuid;

final class Product
{
    private Uuid $uuid;
    private string $name;
    private PriceCollection $prices;

    public function __construct(Uuid $uuid, string $name, PriceCollection $prices)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->prices = $prices;
    }

    public function uuid(): Uuid
    {
        return $this->uuid;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function prices(): PriceCollection
    {
        return $this->prices;
    }
}
