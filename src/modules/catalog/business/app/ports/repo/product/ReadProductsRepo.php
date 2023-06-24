<?php

namespace DDD\Modules\Catalog\Business\App\Ports\Repo\Product;

interface ReadProductsRepo
{
    function readProducts(int $page, int $productsPerPage): array;
}
