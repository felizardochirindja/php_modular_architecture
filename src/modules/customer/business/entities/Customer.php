<?php

namespace DDD\Modules\Customer\Business\Entities;

use DDD\Modules\Catalog\Business\Types\Phone;

final class Customer
{
    public string $id;
    public Cart $cart;

    public function __construct(
        public string $name,
        public Phone $phone,
    ) {}
}
