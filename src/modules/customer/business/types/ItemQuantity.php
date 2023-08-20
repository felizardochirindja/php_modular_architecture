<?php

namespace DDD\Modules\Customer\Business\Types;

use DomainException;

final readonly class ItemQuantity
{
    public function __construct(
        public int $quantity
    ) {
        if ($quantity < 1) {
            throw new DomainException("quantity must be greater than zero");
        }
    }
}
