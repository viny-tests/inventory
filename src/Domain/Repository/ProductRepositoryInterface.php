<?php
declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\ProductCollection;
use App\Domain\Query\ProductCriteria;

interface ProductRepositoryInterface
{
    public function findAllBy(ProductCriteria $criteria): ProductCollection;
}
