<?php

namespace DDD\Modules\Customer\Business\App\Actions\CreateCustomer;

use DDD\Modules\Catalog\Business\Types\Phone;
use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\CreateCartRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Customer\CreateCustomerRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Customer\CreatePhoneRepo;
use DDD\Modules\Customer\Business\Entities\Customer;

final class CreateCustomerAction
{
    public function __construct(
        private CreateCustomerRepo | CreatePhoneRepo | CreateCartRepo $repo,
    ) {}

    public function execute(string $name, string $phone): CreateCustomerOutput
    {
        $customer = new Customer($name, new Phone($phone));

        $createdCustomer = $this->repo->createCustomer($customer->name);
        $this->repo->createPhone($createdCustomer->id, $customer->phone->value);
        $this->repo->createCart($customer->id);

        return new CreateCustomerOutput(
            $createdCustomer->id,
            $customer->name,
            $customer->phone->value,
            $customer->cart->id,
        );
    }
}
