<?php

namespace DDD\Modules\Catalog\Business\App\Ports\Repo\Product;

use DDD\Modules\Catalog\Business\Entities\Product;

interface UpdateProductRepo
{
    public function updateProduct(string $productId, Product $product);
}