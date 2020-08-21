<?php
declare(strict_types=1);

namespace App\Tests\Unit\Domain\Model;

use App\Domain\Model\Price;
use App\Domain\Model\PriceCollection;
use PHPUnit\Framework\TestCase;

class PriceCollectionTest extends TestCase
{
    public function testPriceCollectionAddProducts(): void
    {
        $product = $this->createMock(Price::class);

        $priceCollection = new PriceCollection();
        $priceCollection->add($product);
        $priceCollection->add($product);
        $priceCollection->add($product);

        self::assertInstanceOf(PriceCollection::class, $priceCollection);
        self::assertEquals(3, $priceCollection->count());
    }
}
