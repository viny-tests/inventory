<?php
declare(strict_types=1);

namespace App\Infrastructure\Symfony\Service;

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

    public function __construct(ProductCreateCommandHandler $productCreateCommandHandler)
    {
        $this->productCreateCommandHandler = $productCreateCommandHandler;

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
            $product = new ProductCommand($sku, $name, $description);

            $this->productCreateCommandHandler->handle($product);
        }
    }

    private function cleanDescription(string $description): string
    {
        return trim(str_replace([PHP_EOL], '', $description));
    }
}
