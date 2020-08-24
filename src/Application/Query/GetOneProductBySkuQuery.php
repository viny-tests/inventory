<?php
declare(strict_types=1);

namespace App\Application\Query;

use App\Application\DependencyInjection\ProductRepositoryDependency;
use App\Domain\Model\Product;
use App\Domain\QueryHandler\Product\GetOneProductBySkuHandlerInterface;
use App\Domain\ValueObject\Sku;

class GetOneProductBySkuQuery implements GetOneProductBySkuHandlerInterface
{
    use ProductRepositoryDependency;

    public function handle(Sku $sku): Product
    {
        return $this->productRepository->findOneBySku($sku);
    }
}
