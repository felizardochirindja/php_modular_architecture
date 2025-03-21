<?php

namespace DDD\Modules\Catalog\Business\App\Actions\InsertProduct;

use DDD\Modules\Catalog\Business\App\Actions\InsertProduct\InsertProductOutput;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\ReadCategoryByIdRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\CreateProductRepo;
use DDD\Modules\Catalog\Business\Entities\Product;
use DDD\Modules\Catalog\Business\Types\ProductPrice;
use Exception;

final class InsertProductAction
{
    public function __construct(
        private CreateProductRepo|ReadCategoryByIdRepo $repo,
    ) {}

    public function execute(string $name, float $price, string $categoryId): InsertProductOutput
    {
        $category = $this->repo->readCategoryById($categoryId);

        if (!$category) {
            throw new Exception("category with id of " . $categoryId . ' does not exist!');
        }

        $product = Product::createWithoutId($name, new ProductPrice($price), $category);

        $createdProduct = $this->repo->createProduct($product->name, $product->price, $category->id);

        return new InsertProductOutput(
            $createdProduct->id,
            $createdProduct->name,
            $createdProduct->price,
            $category->id,
            $category->name,
            $category->description,
        );
    }
}
