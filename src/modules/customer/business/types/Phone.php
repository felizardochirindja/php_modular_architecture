<?php

namespace DDD\Modules\Customer\Business\Types;

final readonly class Phone
{
    public function __construct(
        public string $value
    ) {
        // validate phone value
    }
}
