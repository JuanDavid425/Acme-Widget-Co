<?php

declare(strict_types=1);

namespace AcmeWidgetCo\Tests;

use AcmeWidgetCo\AcmeBasketFactory;
use PHPUnit\Framework\TestCase;

final class BasketTest extends TestCase
{
    public function test_example_basket_with_blue_and_green_widgets(): void
    {
        $basket = AcmeBasketFactory::create();

        $basket->add('B01');
        $basket->add('G01');

        $this->assertSame('$37.85', $basket->total());
    }

    public function test_example_basket_with_two_red_widgets(): void
    {
        $basket = AcmeBasketFactory::create();

        $basket->add('R01');
        $basket->add('R01');

        $this->assertSame('$54.37', $basket->total());
    }

    public function test_example_basket_with_red_and_green_widgets(): void
    {
        $basket = AcmeBasketFactory::create();

        $basket->add('R01');
        $basket->add('G01');

        $this->assertSame('$60.85', $basket->total());
    }

    public function test_example_basket_with_blue_blue_red_red_red_widgets(): void
    {
        $basket = AcmeBasketFactory::create();

        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');

        $this->assertSame('$98.27', $basket->total());
    }

    public function test_it_throws_exception_when_adding_unknown_product_code(): void
    {
        $basket = AcmeBasketFactory::create();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unknown product code: INVALID');

        $basket->add('INVALID');
    }
}