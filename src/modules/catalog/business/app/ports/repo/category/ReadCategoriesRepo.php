<?php

namespace DDD\Modules\Catalog\Business\App\Ports\Repo\Category;

interface ReadCategoriesRepo
{
    function readCategories(int $page, int $categoriesPerPage): array;
}
