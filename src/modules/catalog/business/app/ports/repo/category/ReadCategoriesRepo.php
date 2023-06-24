<?php

namespace DDD\Modules\Catalog\Business\App\Ports\Repo\Category;

interface ReadCategoiesRepo
{
    function readCategories(int $page, int $categoriesPerPage): array;
}
