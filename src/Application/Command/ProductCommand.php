<?php
declare(strict_types=1);

namespace App\Application\Command;

use App\Domain\Model\Product;
use App\Domain\ValueObject\Sku;

class ProductCommand
{
    private string $sku;
    private string $name;
    private string $description;

    public function __construct(string $sku, string $name, string $description)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->description = $description;
    }

    public function toModel(): Product
    {
        return new Product(new Sku($this->sku), $this->name, $this->description);
    }
}
