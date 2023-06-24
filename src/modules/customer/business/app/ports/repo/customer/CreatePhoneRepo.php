<?php

namespace DDD\Modules\Customer\Business\App\Ports\Repo\Customer;

interface CreatePhoneRepo
{
    function createPhone(int $customerId, string $phone): void;
}
