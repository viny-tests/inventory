<?php
declare(strict_types=1);

namespace App\Application\Query;

use App\Application\DependencyInjection\ProductRepositoryDependency;
use App\Domain\Model\Product;
use App\Domain\QueryHandler\Product\GetOneProductBySkuAndUnitHandlerInterface;
use App\Domain\ValueObject\Sku;

class GetOneProductBySkuAndUnitQuery implements GetOneProductBySkuAndUnitHandlerInterface
{
    use ProductRepositoryDependency;

    public function handle(Sku $sku, string $unit): Product
    {
        return $this->productRepository->findOneBySkuAndUnit($sku, $unit);
    }
}
