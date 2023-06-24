<?php

namespace DDD\Modules\Catalog\Libs\Repo;

use DDD\Modules\Catalog\Business\App\Ports\Repo\CreateCategoryRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\CreateProductRepo;
use DDD\Modules\Catalog\Business\Entities\Category;
use DDD\Modules\Catalog\Business\Entities\Product;

final class CatalogInMemoryRepo implements CreateProductRepo, CreateCategoryRepo
{
    private array $products = [];
    private array $categories = [];

    public function createProduct(string $name, float $price, string $categoryId): Product
    {
        array_push($products, [$name, $price, $categoryId]);
        return new Product($name, $price, new Category('category 1', 'category 1 description'));
    }

    public function createCategory(string $name, string $description): Category
    {
        array_push($categories, [$name, $description]);
        return new Category($name, $description);
    }
}
