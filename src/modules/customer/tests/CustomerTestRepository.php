<?php

namespace DDD\Modules\Customer\Tests;

use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\CreateCartItemRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\CreateCartRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\GetCartByIdRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\GetItemByIdRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Customer\CreateCustomerRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Customer\CreatePhoneRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Customer\ReadCustomerByNameRepo;

abstract class CustomerTestRepository implements
    GetCartByIdRepo,
    GetItemByIdRepo,
    CreateCartItemRepo,
    CreateCustomerRepo,
    CreatePhoneRepo,
    CreateCartRepo,
    ReadCustomerByNameRepo
{}
