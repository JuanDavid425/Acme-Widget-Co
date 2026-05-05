<?php

declare(strict_types=1);

namespace AcmeWidgetCo\Tests;

use AcmeWidgetCo\Product;
use AcmeWidgetCo\ProductCatalogue;
use PHPUnit\Framework\TestCase;

final class ProductCatalogueTest extends TestCase
{
    public function test_it_returns_a_product_by_code(): void
    {
        $catalogue = new ProductCatalogue([
            'R01' => new Product('R01', 'Red Widget', 3295),
        ]);

        $product = $catalogue->get('R01');

        $this->assertSame('R01', $product->code);
        $this->assertSame('Red Widget', $product->name);
        $this->assertSame(3295, $product->priceInCents);
    }

    public function test_it_throws_exception_for_unknown_product_code(): void
    {
        $catalogue = new ProductCatalogue([]);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unknown product code: INVALID');

        $catalogue->get('INVALID');
    }
}