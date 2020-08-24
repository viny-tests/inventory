<?php
declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller\V1\Actions;

use App\Application\Query\GetProductsQuery;
use App\Domain\Query\ProductCriteria;
use App\Domain\QueryHandler\Product\GetProductQueryHandlerInterface;
use App\Infrastructure\Symfony\Transformers\ProductTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/v1/products", name="products.list", methods={"GET"})
 */
class GetProducts extends AbstractController
{
    private GetProductQueryHandlerInterface $getProductsQuery;
    private Manager $fractal;

    public function __construct(GetProductsQuery $getProductsQuery)
    {
        $this->getProductsQuery = $getProductsQuery;
        $this->fractal = new Manager();
    }

    public function __invoke(Request $request)
    {
        $products = $this->getProductsQuery->handle(new ProductCriteria($request->query->all()));
        $resource = new Collection($products, new ProductTransformer, 'product');

        return $this->json($this->fractal->createData($resource)->toArray());
    }
}
