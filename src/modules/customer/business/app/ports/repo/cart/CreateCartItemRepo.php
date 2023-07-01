<?php

namespace DDD\Modules\Customer\Business\App\Ports\Repo\Cart;

interface CreateCartItemRepo
{
    function createCartItem(int $cartId, int $itemId): bool;
}
