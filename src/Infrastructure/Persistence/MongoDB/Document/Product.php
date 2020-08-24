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
    private $prices;

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
     * @param mixed $id
     * @return Product
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @return mixed
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @param mixed $prices
     * @return Product
     */
    public function setPrices($prices)
    {
        $this->prices = $prices;
        return $this;
    }

    /**
     * @param mixed $createdAt
     * @return Product
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @param mixed $updatedAt
     * @return Product
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }


    /**
     * @PrePersist()
     */
    public function prePersist(): void
    {
        $this->setCreatedAt(new DateTime());
    }

    /**
     * @PreUpdate()
     */
    public function preUpdate(): void
    {
        $this->setUpdatedAt(new DateTime());
    }
}
