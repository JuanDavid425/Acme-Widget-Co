<?php

declare(strict_types=1);

namespace AcmeWidgetCo;

final class AcmeBasketFactory
{
    public static function create(): Basket
    {
        return new Basket(
            self::productCatalogue(),
            self::deliveryCalculator(),
            [
                new RedWidgetHalfPriceOffer(),
            ]
        );
    }

    private static function productCatalogue(): ProductCatalogue
    {
        return new ProductCatalogue([
            'R01' => new Product('R01', 'Red Widget', 3295),
            'G01' => new Product('G01', 'Green Widget', 2495),
            'B01' => new Product('B01', 'Blue Widget', 795),
        ]);
    }

    private static function deliveryCalculator(): DeliveryCalculator
    {
        return new DeliveryCalculator([
            new DeliveryRule(0, 495),
            new DeliveryRule(5000, 295),
            new DeliveryRule(9000, 0),
        ]);
    }
}