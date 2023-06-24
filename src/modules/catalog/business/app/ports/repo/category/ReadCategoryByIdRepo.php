<?php

namespace DDD\Modules\Catalog\Business\App\Ports\Repo\Category;

use DDD\Modules\Catalog\Business\Entities\Category;

interface ReadCategoryByIdRepo
{
    function readCategoryById(string $categoryId): ?Category;
}
