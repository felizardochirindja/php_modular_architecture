<?php

namespace DDD\Modules\Customer\Business\Entities;

final class Cart
{
    public string $id;

    /** @param CartItem[] $item */
    public function __construct(
        public array $items,
    ) {}
}
