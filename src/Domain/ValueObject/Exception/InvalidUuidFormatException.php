<?php
declare(strict_types=1);

namespace App\Domain\ValueObject\Exception;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use function sprintf;

class InvalidUuidFormatException extends RuntimeException
{
    private const MESSAGE = 'Invalid format for your uuid provided: %s';

    public function __construct(string $uuid = "", $code = Response::HTTP_BAD_REQUEST, Throwable $previous = null)
    {
        parent::__construct(sprintf(self::MESSAGE, $uuid), $code, $previous);
    }
}
