<?php

namespace DDD\Modules\Catalog\Business\App\Ports\Repo\Category;

interface RemoveCategoryRepo
{
    public function removeCategory(string $categoryId): bool;
}