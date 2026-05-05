<?php

declare(strict_types=1);

namespace AcmeWidgetCo\Tests;

use AcmeWidgetCo\DeliveryCalculator;
use AcmeWidgetCo\DeliveryRule;
use PHPUnit\Framework\TestCase;

final class DeliveryCalculatorTest extends TestCase
{
    public function test_it_calculates_delivery_for_orders_under_50_dollars(): void
    {
        $calculator = $this->deliveryCalculator();

        $this->assertSame(495, $calculator->calculate(4999));
    }

    public function test_it_calculates_delivery_for_orders_from_50_to_under_90_dollars(): void
    {
        $calculator = $this->deliveryCalculator();

        $this->assertSame(295, $calculator->calculate(5000));
        $this->assertSame(295, $calculator->calculate(8999));
    }

    public function test_it_calculates_free_delivery_for_orders_of_90_dollars_or_more(): void
    {
        $calculator = $this->deliveryCalculator();

        $this->assertSame(0, $calculator->calculate(9000));
    }

    private function deliveryCalculator(): DeliveryCalculator
    {
        return new DeliveryCalculator([
            new DeliveryRule(0, 495),
            new DeliveryRule(5000, 295),
            new DeliveryRule(9000, 0),
        ]);
    }
}