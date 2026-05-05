<?php

declare(strict_types=1);

namespace AcmeWidgetCo;

final class Product
{
    public function __construct(
        public readonly string $code,
        public readonly string $name,
        public readonly int $priceInCents
    ) {
        if ($code === '') {
            throw new \InvalidArgumentException('Product code cannot be empty.');
        }

        if ($name === '') {
            throw new \InvalidArgumentException('Product name cannot be empty.');
        }

        if ($priceInCents < 0) {
            throw new \InvalidArgumentException('Product price cannot be negative.');
        }
    }
}