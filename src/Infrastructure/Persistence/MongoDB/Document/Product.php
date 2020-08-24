<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\MongoDB\Document;

use DateTime;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedMany;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\HasLifecycleCallbacks;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Index;
use Doctrine\ODM\MongoDB\Mapping\Annotations\PrePersist;
use Doctrine\ODM\MongoDB\Mapping\Annotations\PreUpdate;
use Doctrine\ODM\MongoDB\PersistentCollection;

/**
 * @Document(repositoryClass="\App\Infrastructure\Persistence\MongoDB\ProductRepository")
 * @HasLifecycleCallbacks()
 */
class Product
{
    /**
     * @Id
     */
    private $id;

    /**
     * @Field(type="string")
     * @Index(unique=true, order="ASC")
     */
    private string $sku;

    /**
     * @Field(type="string")
     */
    private string $name;

    /**
     * @Field(type="string")
     */
    private string $description;

    /**
     * @EmbedMany(targetDocument=Price::class)
     */
    private PersistentCollection $prices;

    /**
     * @Field(type="date")
     */
    private DateTime $createdAt;

    /**
     * @Field(type="date")
     */
    private DateTime $updatedAt;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     * @return Product
     */
    public function setSku(string $sku): Product
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Product
     */
    public function setName(string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Product
     */
    public function setDescription(string $description): Product
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return PersistentCollection
     */
    public function getPrices(): PersistentCollection
    {
        return $this->prices;
    }


    /**
     * @PrePersist()
     * @codeCoverageIgnore
     */
    public function prePersist(): void
    {
        $this->createdAt = new DateTime();
    }

    /**
     * @PreUpdate()
     * @codeCoverageIgnore
     */
    public function preUpdate(): void
    {
        $this->updatedAt = new DateTime();
    }
}
