<?php

namespace DDD\Modules\Catalog\Business\Types;

final readonly class Phone
{
    public function __construct(
        public string $value
    ) {
        // validate phone value
    }
}
