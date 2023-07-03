<?php

namespace DDD\Modules\Customer\Business\Entities;

use DDD\Modules\Customer\Business\Types\Phone;

final class Customer
{
    public Cart $cart;
    
    private function __construct(
        public ?string $id,
        public string $name,
        public Phone $phone,
    ) {}

    public static function createWithoutId(string $name, Phone $phone): self
    {
        return new self(null, $name, $phone);
    }

    public static function createWithId(string $id, string $name, Phone $phone): self
    {
        return new self($id, $name, $phone);
    }
}
