<?php

namespace DDD\Modules\Customer\Business\App\Actions\UpdateCustomer;

use DDD\Modules\Customer\Business\Types\Phone;
use DDD\Modules\Customer\Business\App\Ports\Repo\Customer\UpdateCustomerRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Customer\ReadCustomerByIdRepo;
use DDD\Modules\Customer\Business\Entities\Customer;
use DomainException;

final class UpdateCustomerAction
{
    public function __construct(
        private UpdateCustomerRepo | ReadCustomerByIdRepo $repo,
    ) {}

    public function execute(string $id, string $name, string $phone): UpdateCustomerOutput
    {
        $customer = $this->repo->readCustomerById($id);

        if (!$customer) {
            throw new DomainException("customer with id of {$id} does not exists");
        }

        $phone = new Phone($phone);

        $customer = Customer::createWithoutId($name, $phone);

        $updatedCustomer = $this->repo->updateCustomer($id, $customer);

        return new UpdateCustomerOutput(
            $updatedCustomer->id,
            $updatedCustomer->name,
            $phone->value,
        );
    }
}
