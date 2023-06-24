<?php

namespace DDD\Modules\Customer\Business\App\Ports\Repo\Customer;

use DDD\Modules\Customer\Business\Entities\Customer;

interface CreateCustomerRepo
{
    function createCustomer(string $name): Customer;
}
