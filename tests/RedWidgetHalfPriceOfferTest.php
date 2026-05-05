<?php

declare(strict_types=1);

namespace AcmeWidgetCo\Tests;

use AcmeWidgetCo\Product;
use AcmeWidgetCo\RedWidgetHalfPriceOffer;
use PHPUnit\Framework\TestCase;

final class RedWidgetHalfPriceOfferTest extends TestCase
{
    public function test_it_applies_no_discount_when_there_are_no_red_widgets(): void
    {
        $offer = new RedWidgetHalfPriceOffer();

        $discount = $offer->discountInMills([
            new Product('B01', 'Blue Widget', 795),
            new Product('G01', 'Green Widget', 2495),
        ]);

        $this->assertSame(0, $discount);
    }

    public function test_it_applies_no_discount_when_there_is_only_one_red_widget(): void
    {
        $offer = new RedWidgetHalfPriceOffer();

        $discount = $offer->discountInMills([
            new Product('R01', 'Red Widget', 3295),
        ]);

        $this->assertSame(0, $discount);
    }

    public function test_it_applies_half_price_discount_for_one_pair_of_red_widgets(): void
    {
        $offer = new RedWidgetHalfPriceOffer();

        $discount = $offer->discountInMills([
            new Product('R01', 'Red Widget', 3295),
            new Product('R01', 'Red Widget', 3295),
        ]);

        $this->assertSame(16475, $discount);
    }

    public function test_it_applies_discount_once_for_three_red_widgets(): void
    {
        $offer = new RedWidgetHalfPriceOffer();

        $discount = $offer->discountInMills([
            new Product('R01', 'Red Widget', 3295),
            new Product('R01', 'Red Widget', 3295),
            new Product('R01', 'Red Widget', 3295),
        ]);

        $this->assertSame(16475, $discount);
    }

    public function test_it_applies_discount_twice_for_four_red_widgets(): void
    {
        $offer = new RedWidgetHalfPriceOffer();

        $discount = $offer->discountInMills([
            new Product('R01', 'Red Widget', 3295),
            new Product('R01', 'Red Widget', 3295),
            new Product('R01', 'Red Widget', 3295),
            new Product('R01', 'Red Widget', 3295),
        ]);

        $this->assertSame(32950, $discount);
    }
}