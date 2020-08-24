<?php
declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller\V1\Actions;

use App\Application\Query\GetProductsQuery;
use App\Domain\Query\ProductCriteria;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/v1/products", name="products.list", methods={"GET"})
 */
class GetProducts extends AbstractController
{
    public function __invoke(GetProductsQuery $getProductsQuery)
    {
        $getProductsQuery->getByCriteria(new ProductCriteria([]));
    }
}
