<?php
declare(strict_types=1);

namespace App\Domain\ValueObject\Exception;

use App\Domain\ValueObject\Sku;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use function sprintf;

class InvalidSkuFormatException extends RuntimeException
{
    private const MESSAGE = 'Invalid format for your sku provided: %s';

    public function __construct(Sku $sku, $code = Response::HTTP_BAD_REQUEST, Throwable $previous = null)
    {
        parent::__construct(sprintf(self::MESSAGE, $sku->value()), $code, $previous);
    }
}
