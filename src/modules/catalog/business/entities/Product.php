<?php

namespace DDD\Modules\Catalog\Business\Entities;

use DDD\Modules\Catalog\Business\Types\ProductPrice;

final readonly class Product
{
    private function __construct(
        public ?string $id,
        public string $name,
        public float $price,
        public Category $category,
    ) {}

    public static function createWithoutId(string $name, ProductPrice $price, Category $category): self
    {
        return new self(null, $name, $price->price, $category);
    }

    public static function createWith(string $id, string $name, ProductPrice $price, Category $category): self
    {
        return new self($id, $name, $price->price, $category);
    }
}
