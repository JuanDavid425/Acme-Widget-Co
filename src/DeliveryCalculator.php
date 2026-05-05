<?php

declare(strict_types=1);

namespace AcmeWidgetCo;

final class DeliveryCalculator
{
    /**
     * @param DeliveryRule[] $rules
     */
    public function __construct(
        private readonly array $rules
    ) {
    }

    public function calculate(int $subtotalInCents): int
    {
        if ($subtotalInCents < 0) {
            throw new \InvalidArgumentException('Subtotal cannot be negative.');
        }

        $matchedChargeInCents = 0;

        foreach ($this->rules as $rule) {
            if ($subtotalInCents >= $rule->minimumSubtotalInCents) {
                $matchedChargeInCents = $rule->chargeInCents;
            }
        }

        return $matchedChargeInCents;
    }
}