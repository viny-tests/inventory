<?php
declare(strict_types=1);

namespace App\Tests\Unit\Domain\Model;

use App\Domain\Model\Price;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{
    public function testCreationOfPrices(): void
    {
        $price = new Price(1000, 'foo', 'EUR');

        self::assertInstanceOf(Price::class, $price);
        self::assertEquals(1000, $price->price());
        self::assertEquals('foo', $price->unit());
        self::assertEquals('EUR', $price->currency());
        self::assertNotEquals(100, $price->price());
    }
}
