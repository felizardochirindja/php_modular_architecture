<?php

namespace DDD\Modules\Customer\Business\App\Ports\Repo\Cart;

use DDD\Modules\Customer\Business\Entities\CartItem;

interface GetItemByIdRepo
{
    function getItemById(string $itemId): CartItem;
}
