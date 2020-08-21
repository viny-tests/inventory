<?php
declare(strict_types=1);

namespace App\Domain\Service\Product;

use App\Domain\Query\ProductCriteria;

interface ProductServiceInterface
{
    public function getByCriteria(ProductCriteria $criteria);
}
