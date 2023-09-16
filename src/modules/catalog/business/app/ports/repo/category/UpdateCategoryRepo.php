<?php

namespace DDD\Modules\Catalog\Business\App\Ports\Repo\Category;

use DDD\Modules\Catalog\Business\Entities\Category;

interface UpdateCategoryRepo
{
    public function updateCategory(Category $category): Category;
}