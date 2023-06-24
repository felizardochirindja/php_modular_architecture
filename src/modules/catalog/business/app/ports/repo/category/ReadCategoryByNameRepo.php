<?php

namespace DDD\Modules\Catalog\Business\App\Ports\Repo\Category;

use DDD\Modules\Catalog\Business\Entities\Category;

interface ReadCategoryByNameRepo
{
    function readCategoryByName(string $categoryId): ?Category;
}
