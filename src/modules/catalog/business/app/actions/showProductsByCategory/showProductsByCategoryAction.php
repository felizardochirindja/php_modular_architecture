<?php

namespace DDD\Modules\Catalog\Business\App\Actions\ShowProducts;

use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\ReadCategoryByIdRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\CountProductsRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\ReadProductsByCategoryIdRepo;
use DomainException;

final class ShowProductsByCategoryAction
{
    public function __construct(
        private ReadCategoryByIdRepo | CountProductsRepo | ReadProductsByCategoryIdRepo $repo,
    ) {}

    public function execute(int $categoryId, int $page, int $productsPerPage): array
    {
        $totalOfProducts = $this->repo->countProducts();

        if ($page < 1) {
            throw new DomainException('page must be greater than 0');
        }

        $totalOfPages = (int) ceil($totalOfProducts / $productsPerPage);

        if ($page > $totalOfProducts) {
            throw new DomainException('page must be less than or equal to ' . $totalOfPages);
        }

        if ($productsPerPage < 5) {
            throw new DomainException('page must be greater than 4');
        }

        $category = $this->repo->readCategoryById($categoryId);

        if (!$category) {
            throw new DomainException("category with id of" . $categoryId . 'does not exist!');
        }

        $products = $this->repo->readProductsByCategoryId($categoryId, $page, $productsPerPage);

        return $products;
    }
} 
