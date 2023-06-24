<?php

namespace DDD\Modules\Customer\Business\Entities;

use DDD\Modules\Catalog\Business\Types\CartStatus;

final class Cart
{
    public string $id;

    /** @param CartItem[] $item */
    public function __construct(
        public array $items,
        public CartStatus $status,
    ) {}
}
