<?php

namespace DDD\Modules\Catalog\Business\App\Ports\Repo\Product;

use DDD\Modules\Catalog\Business\Entities\Product;

interface CreateProductRepo
{
    function createProduct(string $name, float $price, string $categoryId): Product;
}
