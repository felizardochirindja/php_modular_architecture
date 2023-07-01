<?php

namespace DDD\Modules\Catalog\Business\Entities;

final readonly class Category
{
    private function __construct(
        public ?string $id,
        public string $name,
        public string $description,
    ) {}

    public static function createWihoutId(string $name, string $description): self
    {
        return new self(null, $name, $description);
    }

    public static function createWithId(string $id, string $name, string $description): self
    {
        return new self($id, $name, $description);
    }
}
