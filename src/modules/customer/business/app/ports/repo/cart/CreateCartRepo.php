<?php

namespace DDD\Modules\Customer\Business\App\Ports\Repo\Cart;

use DDD\Modules\Customer\Business\Entities\Cart;

interface CreateCartRepo
{
    function createCart(int $customerId): ?Cart;
}
