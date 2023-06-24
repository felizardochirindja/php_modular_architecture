<?php

namespace DDD\Modules\Catalog\Business\App\Ports\Repo\Product;

interface ReadProductsByCategoryIdRepo
{
    function readProductsByCategoryId(int $categoryId, int $page, int $productsPerPage): array;
}
