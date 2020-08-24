<?php
declare(strict_types=1);

namespace App\Application\DependencyInjection;

use App\Domain\Repository\ProductRepositoryInterface;

trait ProductRepositoryDependency
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
}
