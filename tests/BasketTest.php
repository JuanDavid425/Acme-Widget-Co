<?php

declare(strict_types=1);

namespace AcmeWidgetCo\Tests;

use AcmeWidgetCo\Basket;
use AcmeWidgetCo\Product;
use AcmeWidgetCo\ProductCatalogue;
use PHPUnit\Framework\TestCase;

final class BasketTest extends TestCase
{
    public function test_it_adds_products_and_returns_subtotal(): void
    {
        $basket = new Basket($this->catalogue());

        $basket->add('B01');
        $basket->add('G01');

        $this->assertSame('$32.90', $basket->total());
    }

    public function test_it_throws_exception_when_adding_unknown_product_code(): void
    {
        $basket = new Basket($this->catalogue());

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unknown product code: INVALID');

        $basket->add('INVALID');
    }

    private function catalogue(): ProductCatalogue
    {
        return new ProductCatalogue([
            'R01' => new Product('R01', 'Red Widget', 3295),
            'G01' => new Product('G01', 'Green Widget', 2495),
            'B01' => new Product('B01', 'Blue Widget', 795),
        ]);
    }
}