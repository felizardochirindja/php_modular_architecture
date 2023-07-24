<?php

namespace DDD\Modules\Catalog\Tests\Unit;

use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\CountCategoriesRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\CreateCategoryRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\ReadCategoriesRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\ReadCategoryByIdRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\ReadCategoryByNameRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\CountProductsRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\CreateProductRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\ReadProductsByCategoryIdRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\ReadProductsRepo;

abstract class CatalogTestRepository implements
    ReadCategoryByNameRepo,
    CreateCategoryRepo,
    CreateProductRepo,
    ReadCategoryByIdRepo,
    ReadCategoriesRepo,
    CountCategoriesRepo,
    CountProductsRepo,
    ReadProductsByCategoryIdRepo,
    ReadProductsRepo
{}
