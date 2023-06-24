<?php

namespace DDD\Modules\Catalog\Business\App\Actions\InsertCategory;

final readonly class InsertCategoryOutput
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
    ) {}
}
