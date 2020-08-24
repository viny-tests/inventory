<?php
declare(strict_types=1);

namespace App\Domain\Repository\Exception;

use App\Domain\ValueObject\Sku;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use function sprintf;

class ProductNotFoundException extends RuntimeException
{
    private const MESSAGE = 'Product not found with sku provided: %s';

    public function __construct(Sku $sku, $code = Response::HTTP_BAD_REQUEST, Throwable $previous = null)
    {
        parent::__construct(sprintf(self::MESSAGE, $sku->value()), $code, $previous);
    }
}
