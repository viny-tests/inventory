<?php
declare(strict_types=1);

namespace App\Application\Query;

use App\Domain\Model\ProductCollection;
use App\Domain\Query\ProductCriteria;
use App\Domain\QueryHandler\Product\GetProductQueryHandlerInterface;

class GetProductsQuery implements GetProductQueryHandlerInterface
{
    public function getByCriteria(ProductCriteria $criteria): ProductCollection
    {
        // TODO: Implement getByCriteria() method.
    }
}
