<?php
declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller\V1\Actions;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/v1/products/{sku}", name="products.one", methods={"GET"})
 */
class GetOneProduct extends AbstractController
{
    public function __invoke(string $sku)
    {
        dd($sku);
    }
}
