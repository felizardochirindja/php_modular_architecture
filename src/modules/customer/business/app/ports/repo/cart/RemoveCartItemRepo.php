<?php

namespace DDD\Modules\Customer\Business\App\Ports\Repo\Cart;

interface RemoveCartItemRepo
{
    function removeCartItem(int $cartId, int $itemId): bool;
}
