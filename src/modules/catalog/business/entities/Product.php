<?php

namespace DDD\Modules\Catalog\Business\Entities;

final class Product
{
    public string $id;
    
    public function __construct(
        public string $name,
        public float $price,
        public Category $category,
    ) {}
}
