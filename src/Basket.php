<?php

declare(strict_types=1);

namespace AcmeWidgetCo;

final class Basket
{
    /**
     * @var Product[]
     */
    private array $items = [];

    /**
     * @param OfferInterface[] $offers
     */
    public function __construct(
        private readonly ProductCatalogue $productCatalogue,
        private readonly DeliveryCalculator $deliveryCalculator,
        private readonly array $offers = []
    ) {
    }

    public function add(string $productCode): void
    {
        $this->items[] = $this->productCatalogue->get($productCode);
    }

    public function total(): string
    {
        $subtotalInMills = $this->subtotalInMills();
        $discountInMills = $this->discountInMills();

        $discountedSubtotalInMills = $subtotalInMills - $discountInMills;

        $deliveryInCents = $this->deliveryCalculator->calculate(
            $this->millsToCents($discountedSubtotalInMills)
        );

        $totalInMills = $discountedSubtotalInMills + ($deliveryInCents * 10);

        return $this->formatMills($totalInMills);
    }

    private function subtotalInMills(): int
    {
        $subtotalInMills = 0;

        foreach ($this->items as $item) {
            $subtotalInMills += $item->priceInCents * 10;
        }

        return $subtotalInMills;
    }

    private function discountInMills(): int
    {
        $discountInMills = 0;

        foreach ($this->offers as $offer) {
            $discountInMills += $offer->discountInMills($this->items);
        }

        return $discountInMills;
    }

    private function millsToCents(int $amountInMills): int
    {
        return intdiv($amountInMills, 10);
    }

    private function formatMills(int $amountInMills): string
    {
        $amountInCents = $this->millsToCents($amountInMills);

        return '$' . number_format($amountInCents / 100, 2);
    }
}