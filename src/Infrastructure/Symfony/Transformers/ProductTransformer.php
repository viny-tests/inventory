<?php
declare(strict_types=1);

namespace App\Infrastructure\Symfony\Transformers;

use App\Domain\Model\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    public function transform(Product $product): array
    {
        $prices = [];
        foreach ($product->prices() as $price) {
            $prices[] = [
                'price' => $price->price() / 100,
                'currency' => $price->currency(),
                'unit' => $price->unit(),
            ];
        }

        return [
            'sku' => $product->sku()->value(),
            'name' => $product->name(),
            'description' => $product->description(),
            'prices' => $prices,
            'links'   => [
                [
                    'rel' => 'self',
                    'uri' => '/v1/products/' . $product->sku()->value(),
                ]
            ],
        ];
    }
}
