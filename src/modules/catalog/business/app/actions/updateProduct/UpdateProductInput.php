<?php

namespace DDD\Modules\Catalog\Business\App\Actions\UpdateProduct;

final readonly class UpdateProductInput
{
    public function __construct(
        public string $productId,
        public string $productName,
        public float $productPrice,
        public string $categoryId,
    ) {}
}
