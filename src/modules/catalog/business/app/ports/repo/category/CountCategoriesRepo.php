<?php

namespace DDD\Modules\Catalog\Business\App\Ports\Repo\Category;

interface CountCategoriesRepo
{
    function countCategories(): int;
}
