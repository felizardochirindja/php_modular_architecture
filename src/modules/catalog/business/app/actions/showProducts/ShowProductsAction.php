<?php

namespace DDD\Modules\Catalog\Business\App\Actions\ShowProducts;

use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\CountProductsRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\ReadProductsRepo;
use DomainException;

final class ShowProductsAction
{
    public function __construct(
        private ReadProductsRepo | CountProductsRepo $repo,
    ) {}

    public function execute(int $page, int $productsPerPage): array
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
            throw new DomainException('cannot get less than 5 products per page');
        }

        $products = $this->repo->readProducts($page, $productsPerPage);

        return $products;
    }
} 
