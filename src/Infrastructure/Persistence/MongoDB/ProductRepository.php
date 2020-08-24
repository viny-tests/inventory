<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\MongoDB;

use App\Domain\Model\PriceCollection;
use App\Domain\Model\Product;
use App\Domain\Model\Price as DomainPrice;
use App\Domain\Model\ProductCollection;
use App\Domain\Query\ProductCriteria;
use App\Domain\Repository\Exception\ProductNotFoundException;
use App\Domain\Repository\ProductRepositoryInterface;
use App\Domain\ValueObject\Sku;
use App\Infrastructure\Persistence\MongoDB\Document\Price;
use App\Infrastructure\Persistence\MongoDB\Document\Product as ProductMongoDB;
use Doctrine\ODM\MongoDB\MongoDBException;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

class ProductRepository extends DocumentRepository implements ProductRepositoryInterface
{
    public function findAllByCriteria(ProductCriteria $criteria): ProductCollection
    {
        $collection = new ProductCollection();
        $products = $this->findBy($criteria->criteria());

        foreach ($products as $product) {
            $collection->add(
                new Product(
                    new Sku($product->getSku()),
                    $product->getName(),
                    $product->getDescription(),
                    $this->priceCollection($product)
                )
            );
        }

        return $collection;
    }

    private function priceCollection(ProductMongoDB $product): PriceCollection
    {
        $priceCollection = new PriceCollection();
        foreach ($product->getPrices() as $price) {
            $priceCollection->add(new DomainPrice($price->getValue(), $price->getUnit(), $price->getCurrency()));
        }

        return $priceCollection;
    }

    public function findOneBySku(Sku $sku): Product
    {
        /**
         * @var ProductMongoDB $productDB
         */
        $productDB = $this->getBySku($sku->value());
        if ($productDB === null) {
            throw new ProductNotFoundException($sku);
        }

        return new Product(
            new Sku($productDB->getSku()),
            $productDB->getName(),
            $productDB->getDescription(),
            $this->priceCollection($productDB)
        );
    }

    public function store(Product $product): void
    {
        $session = $this->dm->getClient()->startSession();
        $session->startTransaction([]);

        try {
            $productDB = $this->getBySku($product->sku()->value()) ?? new ProductMongoDB();
            $productDB->setName($product->name())
                ->setDescription($product->description())
                ->setSku($product->sku()->value());

            if (is_null($productDB->getId())) {
                $this->dm->persist($productDB);
            }
            $this->dm->flush();
            $session->commitTransaction();
        } catch (MongoDBException $e) {
            $session->abortTransaction();
        }

        $session->endSession();
    }

    private function getBySku(string $sku): ?object
    {
        return $this->findOneBy(['sku' => $sku]);
    }

    public function update(Product $product): void
    {
        $session = $this->dm->getClient()->startSession();
        $session->startTransaction([]);

        try {
            /** @var ProductMongoDB $productDB */
            $productDB = $this->getBySku($product->sku()->value());
            $productDB->setName($product->name())
                ->setDescription($product->description())
                ->setSku($product->sku()->value());

            foreach ($product->prices() as $price) {
                $document = $productDB->getPrices()->filter(static function ($current) use ($price) {
                    return $current->getUnit() === $price->unit();
                })->current();

                $priceDB = $document instanceof Price ? $document : new Price();
                $priceDB->setCurrency($price->currency())
                    ->setUnit($price->unit())
                    ->setValue($price->price());

                if ($document === false) {
                    $productDB->getPrices()->add($priceDB);
                }
            }

            $this->dm->flush();
            $session->commitTransaction();
        } catch (MongoDBException $e) {
            $session->abortTransaction();
        }

        $session->endSession();
    }
}
