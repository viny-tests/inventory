<?php
declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\ValueObject\Exception\InvalidSkuFormatException;

class Sku
{
    private string $sku;

    public function __construct(string $sku)
    {
        $this->sku = $sku;

        $this->validate();
    }

    public function value(): string
    {
        return $this->sku;
    }

    private function validate(): void
    {
        if (filter_var(
            $this->sku,
            FILTER_VALIDATE_REGEXP,
            ['options' => ['regexp' => '/^[A-Z]{2}\-[0-9]{2}$/i']]
        ) === false) {
            throw new InvalidSkuFormatException($this);
        }
    }
}
