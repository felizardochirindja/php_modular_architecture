<?php

namespace DDD\Modules\Catalog\Business\Entities;

final readonly class Product
{
    private function __construct(
        public ?string $id,
        public string $name,
        public float $price,
        public Category $category,
    ) {}

    public static function createWithoutId(string $name, float $price, Category $category): self
    {
        return new self(null, $name, $price, $category);
    }

    public static function createWith(string $id, string $name, float $price, Category $category): self
    {
        return new self($id, $name, $price, $category);
    }
}
