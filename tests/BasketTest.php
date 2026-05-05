<?php

declare(strict_types=1);

namespace AcmeWidgetCo\Tests;

use AcmeWidgetCo\Basket;
use AcmeWidgetCo\DeliveryCalculator;
use AcmeWidgetCo\DeliveryRule;
use AcmeWidgetCo\Product;
use AcmeWidgetCo\ProductCatalogue;
use AcmeWidgetCo\RedWidgetHalfPriceOffer;
use PHPUnit\Framework\TestCase;

final class BasketTest extends TestCase
{
    public function test_it_adds_products_and_calculates_total_with_delivery(): void
    {
        $basket = $this->basket();

        $basket->add('B01');
        $basket->add('G01');

        $this->assertSame('$37.85', $basket->total());
    }

    public function test_it_throws_exception_when_adding_unknown_product_code(): void
    {
        $basket = $this->basket();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unknown product code: INVALID');

        $basket->add('INVALID');
    }

    private function basket(): Basket
    {
        return new Basket(
            $this->catalogue(),
            $this->deliveryCalculator(),
            [
                new RedWidgetHalfPriceOffer(),
            ]
        );
    }

    private function catalogue(): ProductCatalogue
    {
        return new ProductCatalogue([
            'R01' => new Product('R01', 'Red Widget', 3295),
            'G01' => new Product('G01', 'Green Widget', 2495),
            'B01' => new Product('B01', 'Blue Widget', 795),
        ]);
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