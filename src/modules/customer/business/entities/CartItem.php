<?php

namespace DDD\Modules\Customer\Business\Entities;

final class CartItem
{
    public string $id;

    public function __construct(
        public string $name,
        public float $price,
        public int $categoryId,
    ) {}
}
