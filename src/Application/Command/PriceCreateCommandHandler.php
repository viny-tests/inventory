<?php
declare(strict_types=1);

namespace App\Application\Command;

use App\Application\DependencyInjection\ProductRepositoryDependency;
use App\Domain\Repository\Exception\ProductNotFoundException;

class PriceCreateCommandHandler
{
    use ProductRepositoryDependency;

    public function handle(PriceCommand $priceCommand): void
    {
        try {
            $productAggregate = $this->productRepository->findOneBySku($priceCommand->sku());
            $productAggregate->addPrice($priceCommand->toModel());

            $this->productRepository->update($productAggregate);
        } catch (ProductNotFoundException $e) {
        }
    }
}
