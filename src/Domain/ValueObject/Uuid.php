<?php
declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\ValueObject\Exception\InvalidUuidFormatException;

final class Uuid
{
    private string $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;

        $this->validate();
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    private function validate(): void
    {
        if (filter_var(
                $this->uuid,
                FILTER_VALIDATE_REGEXP,
                ['options' => ['regexp' => '/^[0-9a-fA-F]{8}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{12}$/i']]
            ) === false) {
            throw new InvalidUuidFormatException($this->uuid);
        }
    }
}
