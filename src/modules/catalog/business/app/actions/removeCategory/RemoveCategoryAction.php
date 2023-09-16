<?php

namespace DDD\Modules\Catalog\Business\App\Actions\RemoveCategory;

use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\ReadCategoryByIdRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\RemoveCategoryRepo;
use DomainException;

final class RemoveCategoryAction
{
    public function __construct(
        private ReadCategoryByIdRepo|RemoveCategoryRepo $repo
    ){}

    public function __invoke(string $categoryId): bool
    {
        $category = $this->repo->readCategoryById($categoryId);

        if (!$category) {
            throw new DomainException("category with id of $categoryId does not exist!");
        }

        return $this->repo->removeCategory($categoryId);
    }
}
