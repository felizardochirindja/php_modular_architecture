<?php

namespace DDD\Modules\Catalog\Business\App\Actions\InsertProduct;

final readonly class InsertProductOutput
{
    public function __construct(
        public string $id,
        public string $name,
        public float $price,
        public string $categoryId,
        public string $categoryName,
        public string $categoryDescription,
    ) {}
}
