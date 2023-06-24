<?php

namespace DDD\Modules\Catalog\Business\Entities;

final class Category
{
    public string $id;

    public function __construct(
        public string $name,
        public string $description,
    ) {}
}
