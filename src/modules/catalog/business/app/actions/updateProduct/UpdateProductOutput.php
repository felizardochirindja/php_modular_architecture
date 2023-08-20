<?php

namespace DDD\Modules\Catalog\Business\App\Actions\updateProduct;

final readonly class UpdateProductOutput
{
    public function __construct(
        public string $productId,
        public string $productName,
        public float $productPrice,
        public string $categoryId,
        public string $categoryName,
        public string $categoryDescription,
    ) {}
}
