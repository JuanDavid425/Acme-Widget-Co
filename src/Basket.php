<?php

declare(strict_types=1);

namespace AcmeWidgetCo;

final class Basket
{
    /**
     * @var Product[]
     */
    private array $items = [];

    public function __construct(
        private readonly ProductCatalogue $productCatalogue
    ) {
    }

    public function add(string $productCode): void
    {
        $this->items[] = $this->productCatalogue->get($productCode);
    }

    public function total(): string
    {
        $subtotalInCents = 0;

        foreach ($this->items as $item) {
            $subtotalInCents += $item->priceInCents;
        }

        return $this->formatCents($subtotalInCents);
    }

    private function formatCents(int $amountInCents): string
    {
        return '$' . number_format($amountInCents / 100, 2);
    }
}