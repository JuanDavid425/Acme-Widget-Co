<?php

declare(strict_types=1);

namespace AcmeWidgetCo;

final class DeliveryRule
{
    public function __construct(
        public readonly int $minimumSubtotalInCents,
        public readonly int $chargeInCents
    ) {
        if ($minimumSubtotalInCents < 0) {
            throw new \InvalidArgumentException('Minimum subtotal cannot be negative.');
        }

        if ($chargeInCents < 0) {
            throw new \InvalidArgumentException('Delivery charge cannot be negative.');
        }
    }
}