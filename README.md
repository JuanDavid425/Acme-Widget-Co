# Acme Widget Co Basket

Proof of concept implementation for Acme Widget Co's basket pricing system.

This project implements a small backend/domain pricing engine in modern PHP.

## Features

- Product catalogue based pricing
- Basket item management
- Delivery charge rules
- Promotional offer support
- Red widget half-price offer
- PHPUnit test coverage for the provided examples

## Products

| Product Code | Product Name | Price |
| ------------ | ------------ | ----- |
| R01 | Red Widget | $32.95 |
| G01 | Green Widget | $24.95 |
| B01 | Blue Widget | $7.95 |

## Delivery Rules

| Discounted Basket Subtotal | Delivery Charge |
| -------------------------- | --------------- |
| Less than $50 | $4.95 |
| $50 or more, less than $90 | $2.95 |
| $90 or more | Free |

## Offers

The initial offer is:

> Buy one red widget, get the second red widget half price.

This applies once per pair of red widgets.

Examples:

- 1 red widget: no discount
- 2 red widgets: 1 discount
- 3 red widgets: 1 discount
- 4 red widgets: 2 discounts

## Installation

```bash
composer install
```

## Running Tests

```bash
composer test
```

or:

```bash
vendor/bin/phpunit
```

On Windows:

```powershell
vendor\bin\phpunit
```

## Usage Example

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use AcmeWidgetCo\AcmeBasketFactory;

$basket = AcmeBasketFactory::create();

$basket->add('B01');
$basket->add('G01');

echo $basket->total(); // $37.85
```

## Provided Examples

| Products | Expected Total |
| -------- | -------------- |
| B01, G01 | $37.85 |
| R01, R01 | $54.37 |
| R01, G01 | $60.85 |
| B01, B01, R01, R01, R01 | $98.27 |

## Assumptions

- The task is treated as a backend/domain logic proof of concept.
- No framework, database, API, or frontend is required.
- Product prices are stored in cents.
- Basket calculations use mills internally where needed.
- One mill is one tenth of a cent.
- This avoids floating point precision issues for the red widget half-price offer.
- Offers are applied before delivery charges.
- Delivery is calculated from the discounted basket subtotal.
- Final totals are formatted as dollars with two decimal places.
- The final display truncates fractions of a cent to match the provided expected totals.
- Unknown product codes throw an `InvalidArgumentException`.

## Design Overview

The implementation is intentionally small and focused.

### `Basket`

Responsible for:

- Adding products by product code
- Calculating subtotal
- Applying offers
- Applying delivery
- Returning the final formatted total

### `ProductCatalogue`

Responsible for:

- Storing products
- Looking up products by code
- Rejecting unknown product codes

### `DeliveryCalculator`

Responsible for:

- Calculating the delivery charge from the discounted basket subtotal

### `OfferInterface`

Allows promotional offers to be added without changing the basket class.

### `RedWidgetHalfPriceOffer`

Implements the current offer:

> Buy one red widget, get the second half price.

### `AcmeBasketFactory`

Provides a convenient way to create the standard Acme basket with:

- The provided product catalogue
- The provided delivery rules
- The red widget promotional offer