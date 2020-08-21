<?php
declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\Query\ProductCriteria;
use App\Domain\Repository\ProductRepositoryInterface;
use App\Domain\Service\Product\ProductServiceInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

final class ProductService implements ProductServiceInterface
{
    private MessageBusInterface $messageBus;
    private ProductRepositoryInterface $productRepository;

    public function __construct(MessageBusInterface $messageBus, ProductRepositoryInterface $productRepository)
    {
        $this->messageBus = $messageBus;
        $this->productRepository = $productRepository;
    }

    /**
     * @param ProductCriteria $criteria
     * @return Envelope
     */
    public function getByCriteria(ProductCriteria $criteria)
    {
        $collection = $this->productRepository->findAllBy($criteria);

        return $this->messageBus->dispatch();
    }
}
