<?php

namespace DDD\Modules\Catalog\Business\App\Ports\Repo\Category;

use DDD\Modules\Catalog\Business\Entities\Category;

interface CreateCategoryRepo
{
    function createCategory(string $name, string $description): Category;
}
