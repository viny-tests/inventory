<?php
declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Product;
use App\Domain\Model\ProductCollection;
use App\Domain\Query\ProductCriteria;
use App\Domain\ValueObject\Sku;

interface ProductRepositoryInterface
{
    public function findAllByCriteria(ProductCriteria $criteria): ProductCollection;
    public function findOneBySku(Sku $sku): Product;
    public function store(Product $product): void;
    public function update(Product $product): void;
}
