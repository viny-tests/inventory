<?php
declare(strict_types=1);

namespace App\Domain\Query;

class ProductCriteria
{
    private array $criteria;

    public function __construct(array $criteria)
    {
        $this->criteria = $criteria;
    }

    public function criteria(): array
    {
        return $this->criteria;
    }
}
