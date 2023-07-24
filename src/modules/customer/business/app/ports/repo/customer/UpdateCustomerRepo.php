<?php

namespace DDD\Modules\Customer\Business\App\Ports\Repo\Customer;

use DDD\Modules\Customer\Business\Entities\Customer;

interface UpdateCustomerRepo
{
    function updateCustomer(string $id, Customer $customer): Customer;
}
