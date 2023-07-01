<?php

namespace DDD\Modules\Customer\Tests;

use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\CreateCartItemRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\GetCartByIdRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\GetItemByIdRepo;

abstract class CustomerTestRepository implements
    GetCartByIdRepo,
    GetItemByIdRepo,
    CreateCartItemRepo
{}
