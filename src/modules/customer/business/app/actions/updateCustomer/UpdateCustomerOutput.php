<?php

namespace DDD\Modules\Customer\Business\App\Actions\UpdateCustomer;

final readonly class UpdateCustomerOutput
{
    public function __construct(
        public string $id,
        public string $name,
        public string $phone,
    ) {}
}
