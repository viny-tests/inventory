<?php
declare(strict_types=1);

namespace App\Domain\QueryHandler\Product;

use App\Domain\Model\Product;
use App\Domain\ValueObject\Sku;

interface GetOneProductBySkuHandlerInterface
{
    public function getBySku(Sku $sku): Product;
}
