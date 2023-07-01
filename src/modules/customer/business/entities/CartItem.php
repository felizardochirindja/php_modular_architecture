<?php

namespace DDD\Modules\Customer\Business\Entities;

final readonly class CartItem
{
    private function __construct(
        public ?string $id,
        public string $name,
        public float $price,
        public int $categoryId,
        public int $quantity,
    ) {}

    public static function createWithoutId(string $name, float $price, string $categoryId, int $quantity): self
    {
        return new self(null, $name, $price, $categoryId, $quantity);
    }

    public static function createWithId(string $id, string $name, float $price, string $categoryId, int $quantity): self
    {
        return new self($id, $name, $price, $categoryId, $quantity);
    }
}
