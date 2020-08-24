<?php
declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller\V1\Actions;

use App\Application\Query\GetOneProductBySkuQuery;
use App\Domain\QueryHandler\Product\GetOneProductBySkuHandlerInterface;
use App\Domain\ValueObject\Sku;
use App\Infrastructure\Symfony\Transformers\ProductTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/v1/products/{sku}", name="products.one", methods={"GET"})
 */
class GetOneProduct extends AbstractController
{
    private GetOneProductBySkuHandlerInterface $getOneProductBySkuQuery;
    private Manager $fractal;

    public function __construct(GetOneProductBySkuQuery $getOneProductBySkuQuery)
    {
        $this->getOneProductBySkuQuery = $getOneProductBySkuQuery;
        $this->fractal = new Manager();
    }

    public function __invoke(string $sku)
    {
        $product = $this->getOneProductBySkuQuery->handle(new Sku($sku));
        $resource = new Item($product, new ProductTransformer, 'product');

        return $this->json($this->fractal->createData($resource)->toArray());
    }
}
