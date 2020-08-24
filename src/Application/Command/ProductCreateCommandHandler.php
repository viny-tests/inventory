<?php
declare(strict_types=1);

namespace App\Application\Command;

use App\Application\DependencyInjection\ProductRepositoryDependency;

class ProductCreateCommandHandler
{
    use ProductRepositoryDependency;

    public function handle(ProductCommand $productCommand): void
    {
        $this->productRepository->store($productCommand->toModel());
    }
}
