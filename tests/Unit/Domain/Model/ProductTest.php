<?php
declare(strict_types=1);

namespace App\Tests\Unit\Domain\Model;

use App\Domain\Model\PriceCollection;
use App\Domain\Model\Product;
use App\Domain\ValueObject\Exception\InvalidUuidFormatException;
use App\Domain\ValueObject\Uuid;
use App\Infrastructure\PurePhpUuidGeneratorV4;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProductCreationExpectingUuidException(): void
    {
        $this->expectException(InvalidUuidFormatException::class);

        $uuid = new Uuid('foo');
        $name = 'Product #1';
        $price = $this->createMock(PriceCollection::class);

        $product = new Product($uuid, $name, $price);

        self::assertEquals($product->uuid(), $uuid);
        self::assertEquals($product->name(), $name);
        self::assertEquals($product->prices(), $price);
        self::assertEquals($product->uuid()->uuid(), $uuid->uuid());
    }

    public function testProductCreation(): void
    {
        $uuid = new Uuid(PurePhpUuidGeneratorV4::generate());
        $name = 'Product #1';
        $price = $this->createMock(PriceCollection::class);

        $product = new Product($uuid, $name, $price);

        self::assertEquals($product->uuid(), $uuid);
        self::assertEquals($product->name(), $name);
        self::assertEquals($product->prices(), $price);
        self::assertEquals($product->uuid()->uuid(), $uuid->uuid());
    }
}
