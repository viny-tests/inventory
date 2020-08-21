<?php
declare(strict_types=1);

namespace App\Tests\Unit\Domain\Model;

use App\Domain\Model\Product;
use App\Domain\Model\ProductCollection;
use PHPUnit\Framework\TestCase;

class ProductCollectionTest extends TestCase
{
    public function testCollectionCreation(): void
    {
        $product = $this->createMock(Product::class);

        $productCollection = new ProductCollection();
        $productCollection->add($product);
        $productCollection->add($product);
        $productCollection->add($product);
        $productCollection->add($product);
        $productCollection->add($product);

        self::assertCount(5, $productCollection);
    }
}
