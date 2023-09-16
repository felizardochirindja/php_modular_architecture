<?php

namespace DDD\Modules\Catalog\Business\App\Actions\updateCategory;

final readonly class UpdateCategoryOutput
{
    public function __construct(
        public string $categoryId,
        public string $categoryName,
        public string $categoryDescription,
    ){}
}
