<?php

declare(strict_types=1);

namespace AcmeWidgetCo;

final class RedWidgetHalfPriceOffer implements OfferInterface
{
    private const RED_WIDGET_CODE = 'R01';

    /**
     * @param Product[] $items
     */
    public function discountInMills(array $items): int
    {
        $redWidgetCount = 0;
        $redWidgetPriceInMills = null;

        foreach ($items as $item) {
            if ($item->code !== self::RED_WIDGET_CODE) {
                continue;
            }

            $redWidgetCount++;
            $redWidgetPriceInMills = $item->priceInCents * 10;
        }

        if ($redWidgetCount < 2 || $redWidgetPriceInMills === null) {
            return 0;
        }

        $discountedPairs = intdiv($redWidgetCount, 2);

        return $discountedPairs * intdiv($redWidgetPriceInMills, 2);
    }
}