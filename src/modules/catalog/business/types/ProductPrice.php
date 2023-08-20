<?php

namespace DDD\Modules\Catalog\Business\Price;

use DomainException;

final readonly class ProductPrice
{
    public function __construct(
        public int $price
    ) {
        if ($price < 0) {
            throw new DomainException("price must be greater than zero");
        }
    }
}
