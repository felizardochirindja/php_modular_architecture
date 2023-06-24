<?php

namespace DDD\Modules\Customer\Business\App\Ports\Repo\Cart;

interface CreateCartRepo
{
    function createCart(int $customerId): void;
}
