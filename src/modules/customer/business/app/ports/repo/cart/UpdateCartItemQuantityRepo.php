<?php

namespace DDD\Modules\Customer\Business\App\Ports\Repo\Cart;

interface UpdateCartItemQuantityRepo
{
    function updateCartItemQuantity(int $cartId, int $itemId, int $quantity): bool;
}
