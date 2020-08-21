<?php
declare(strict_types=1);

namespace App\Domain\ValueObject;

final class Uuid
{
    private string $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }
}
