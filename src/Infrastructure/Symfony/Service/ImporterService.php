<?php
declare(strict_types=1);

namespace App\Infrastructure\Symfony\Service;

use App\Application\Command\PriceCommand;
use App\Application\Command\PriceCreateCommandHandler;
use App\Application\Command\ProductCommand;
use App\Application\Command\ProductCreateCommandHandler;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use function file_get_contents;
use function trim;
use function str_replace;
use function is_null;
use function dirname;

class ImporterService
{
    private string $importPath;
    private ProductCreateCommandHandler $productCreateCommandHandler;
    private PriceCreateCommandHandler $priceCreateCommandHandler;

    public function __construct(ProductCreateCommandHandler $productCreateCommandHandler, PriceCreateCommandHandler $priceCreateCommandHandler)
    {
        $this->productCreateCommandHandler = $productCreateCommandHandler;
        $this->priceCreateCommandHandler = $priceCreateCommandHandler;

        $this->importPath = dirname(__DIR__, 4) . '/import';
    }

    public function importProducts(): void
    {
        $productFile = $this->importPath . '/products.xml';

        $products = (new XmlEncoder())->decode(file_get_contents($productFile), 'xml');
        if (is_null($products['Product'])) {
            return ;
        }

        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        foreach ($products['Product'] as $product) {
            $name = $propertyAccessor->getValue($product, '[Name]');
            $description = $this->cleanDescription($propertyAccessor->getValue($product, '[Description]'));
            $sku = $propertyAccessor->getValue($product, '[sku]');
            $command = new ProductCommand($sku, $name, $description);

            $this->productCreateCommandHandler->handle($command);
        }
    }

    public function importPrices(): void
    {
        $pricesFile = $this->importPath . '/prices.json';
        $prices = json_decode(file_get_contents($pricesFile), false, 512, JSON_THROW_ON_ERROR);

        foreach ($prices as $price) {
            $command = new PriceCommand($price->id, (int) $price->price->value * 100, $price->price->currency, $price->unit);

            $this->priceCreateCommandHandler->handle($command);
        }
    }

    private function cleanDescription(string $description): string
    {
        return trim(str_replace([PHP_EOL], '', $description));
    }
}
