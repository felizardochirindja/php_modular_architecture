<?php

namespace DDD\Modules\Catalog\Business\Types;

use DomainException;

final readonly class ProductPrice
{
    public function __construct(
        public float $price
    ) {
        if ($price < 0) {
            throw new DomainException("price must be greater than zero");
        }
    }
}
