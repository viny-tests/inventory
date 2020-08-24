<?php
declare(strict_types=1);

namespace App\Domain\QueryHandler\Product;

use App\Domain\Model\ProductCollection;
use App\Domain\Query\ProductCriteria;

interface GetProductQueryHandlerInterface
{
    public function handle(ProductCriteria $criteria): ProductCollection;
}
