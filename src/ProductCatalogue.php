<?php

declare(strict_types=1);

namespace AcmeWidgetCo;

final class ProductCatalogue
{
    /**
     * @param array<string, Product> $products
     */
    public function __construct(
        private readonly array $products
    ) {
    }

    public function get(string $productCode): Product
    {
        if (!isset($this->products[$productCode])) {
            throw new \InvalidArgumentException("Unknown product code: {$productCode}");
        }

        return $this->products[$productCode];
    }
}