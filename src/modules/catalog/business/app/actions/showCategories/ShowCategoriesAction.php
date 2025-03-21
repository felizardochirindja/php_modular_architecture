<?php

namespace DDD\Modules\Catalog\Business\App\Actions\ShowCategories;

use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\CountCategoriesRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\ReadCategoriesRepo;
use DomainException;

final class ShowCategoriesAction
{
    public function __construct(
        private ReadCategoriesRepo | CountCategoriesRepo $repo,
    ) {}

    public function execute(int $page, int $categoriesPerPage): array
    {
        $totalOfCategories = $this->repo->countCategories();

        if ($page < 1) {
            throw new DomainException('page must be greater than 0');
        }

        $totalOfPages = (int) ceil($totalOfCategories / $categoriesPerPage);

        if ($page > $totalOfCategories) {
            throw new DomainException('page must be less than or equal to ' . $totalOfPages);
        }

        if ($categoriesPerPage < 5) {
            throw new DomainException('cannot get less than 5 categories per page');
        }

        $categories = $this->repo->readCategories($page, $categoriesPerPage);

        return $categories;
    }
} 
