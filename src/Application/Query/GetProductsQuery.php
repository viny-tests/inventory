<?php
declare(strict_types=1);

namespace App\Application\Query;

use App\Application\DependencyInjection\ProductRepositoryDependency;
use App\Domain\Model\ProductCollection;
use App\Domain\Query\ProductCriteria;
use App\Domain\QueryHandler\Product\GetProductQueryHandlerInterface;

class GetProductsQuery implements GetProductQueryHandlerInterface
{
    use ProductRepositoryDependency;

    public function handle(ProductCriteria $criteria): ProductCollection
    {
        return $this->productRepository->findAllByCriteria($criteria);
    }
}
