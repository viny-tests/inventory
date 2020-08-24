<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\MongoDB\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbeddedDocument;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;

/**
 * @EmbeddedDocument
 */
class Price
{
    /** @Field(type="int") */
    private int $value;

    /** @Field(type="string") */
    private string $unit;

    /** @Field(type="string") */
    private string $currency;

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return Price
     */
    public function setValue(int $value): Price
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     * @return Price
     */
    public function setUnit(string $unit): Price
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return Price
     */
    public function setCurrency(string $currency): Price
    {
        $this->currency = $currency;
        return $this;
    }
}
