<?php

namespace DDD\Modules\Customer\Business\App\Actions\CreateCustomer;

final readonly class CreateCustomerOutput
{
    public function __construct(
        public string $id,
        public string $name,
        public string $phone,
        public string $cartId,
    ) {}
}
