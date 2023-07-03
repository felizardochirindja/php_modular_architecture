<?php

namespace DDD\Modules\Customer\Business\App\Actions\CreateCustomer;

use DDD\Modules\Customer\Business\Types\Phone;
use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\CreateCartRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Customer\CreateCustomerRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Customer\CreatePhoneRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Customer\ReadCustomerByNameRepo;
use DomainException;

final class CreateCustomerAction
{
    public function __construct(
        private CreateCustomerRepo | CreatePhoneRepo | CreateCartRepo | ReadCustomerByNameRepo $repo,
    ) {}

    public function execute(string $name, string $phone): CreateCustomerOutput
    {
        $customer = $this->repo->readCustomerByName($name);

        if ($customer) {
            throw new DomainException("customer with name of {$name} already exists");
        }

        $phone = new Phone($phone);

        $createdCustomer = $this->repo->createCustomer($name);
        $this->repo->createPhone($createdCustomer->id, $phone->value);
        $cart = $this->repo->createCart($createdCustomer->id);

        return new CreateCustomerOutput(
            $createdCustomer->id,
            $createdCustomer->name,
            $createdCustomer->phone->value,
            $cart->id,
        );
    }
}
