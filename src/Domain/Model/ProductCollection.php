<?php
declare(strict_types=1);

namespace App\Domain\Model;

use ArrayIterator;

class ProductCollection extends ArrayIterator
{
    public function add(Product $product): void
    {
        $this->append($product);
    }
}
