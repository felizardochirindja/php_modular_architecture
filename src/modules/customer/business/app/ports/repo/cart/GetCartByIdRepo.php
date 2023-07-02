<?php

namespace DDD\Modules\Customer\Business\App\Ports\Repo\Cart;

use DDD\Modules\Customer\Business\Entities\Cart;

interface GetCartByIdRepo
{
    function getCartByIdRepo(string $cartId): ?Cart;
}
