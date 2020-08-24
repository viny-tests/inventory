<?php
declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller\V1\Actions;

use App\Application\Query\GetOneProductBySkuAndUnitQuery;
use App\Domain\QueryHandler\Product\GetOneProductBySkuAndUnitHandlerInterface;
use App\Domain\ValueObject\Sku;
use App\Infrastructure\Symfony\Transformers\ProductTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/v1/products/{sku}/units/{unit}", name="products.one.unit", methods={"GET"})
 */
class GetOneProductByUnit extends AbstractController
{
    private GetOneProductBySkuAndUnitHandlerInterface $getOneProductBySkuAndUnitQuery;
    private Manager $fractal;

    public function __construct(GetOneProductBySkuAndUnitQuery $getOneProductBySkuAndUnitQuery)
    {
        $this->getOneProductBySkuAndUnitQuery = $getOneProductBySkuAndUnitQuery;
        $this->fractal = new Manager();
    }

    public function __invoke(string $sku, $unit)
    {
        $product = $this->getOneProductBySkuAndUnitQuery->handle(new Sku($sku), $unit);
        $resource = new Item($product, new ProductTransformer, 'product');

        return $this->json($this->fractal->createData($resource)->toArray());
    }
}
