<?php
declare(strict_types=1);

namespace App\Tests\Unit\Domain\Model;

use App\Domain\Model\PriceCollection;
use App\Domain\Model\Product;
use App\Domain\ValueObject\Exception\InvalidSkuFormatException;
use App\Domain\ValueObject\Sku;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProductCreationExpectingUuidException(): void
    {
        $this->expectException(InvalidSkuFormatException::class);

        $sku = new Sku('foo');
        $name = 'Product #1';
        $description = 'Product #1 Description';
        $price = $this->createMock(PriceCollection::class);

        $product = new Product($sku, $name, $description);

        self::assertEquals($product->sku(), $sku);
        self::assertEquals($product->name(), $name);
        self::assertEquals($product->prices(), $price);
        self::assertEquals($product->sku()->value(), $sku->value());
    }

    public function testProductCreation(): void
    {
        $sku = new Sku('AA-22');
        $name = 'Product #1';
        $description = 'Product #1 Description';
        $price = $this->createMock(PriceCollection::class);

        $product = new Product($sku, $name, $description, $price);

        self::assertEquals($product->sku(), $sku);
        self::assertEquals($product->name(), $name);
        self::assertEquals($product->prices(), $price);
        self::assertEquals($product->sku()->value(), $sku->value());
    }
}
