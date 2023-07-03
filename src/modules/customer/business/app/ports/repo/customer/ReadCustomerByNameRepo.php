<?php

namespace DDD\Modules\Customer\Business\App\Ports\Repo\Customer;

use DDD\Modules\Customer\Business\Entities\Customer;

interface ReadCustomerByNameRepo
{
    function readCustomerByName(string $name): ?Customer;
}
