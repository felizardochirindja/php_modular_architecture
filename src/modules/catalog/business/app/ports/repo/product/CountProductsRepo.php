<?php

namespace DDD\Modules\Catalog\Business\App\Ports\Repo\Product;

interface CountProductsRepo
{
    function countProducts(): int;
}
