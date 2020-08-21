<?php
declare(strict_types=1);

namespace App\Domain\Model;

use ArrayIterator;

class PriceCollection extends ArrayIterator
{
    public function add(Price $price): void
    {
        $this->append($price);
    }
}
