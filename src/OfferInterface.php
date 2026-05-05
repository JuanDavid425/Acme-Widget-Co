<?php

declare(strict_types=1);

namespace AcmeWidgetCo;

interface OfferInterface
{
    /**
     * @param Product[] $items
     */
    public function discountInMills(array $items): int;
}