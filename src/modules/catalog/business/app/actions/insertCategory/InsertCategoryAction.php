<?php

namespace DDD\Modules\Catalog\Business\App\Actions\InsertCategory;

use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\CreateCategoryRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\ReadCategoryByNameRepo;
use DDD\Modules\Catalog\Business\Entities\Category;
use DomainException;

final class InsertCategoryAction
{
    public function __construct(
        private ReadCategoryByNameRepo | CreateCategoryRepo $repo
    ) {}

    public function execute(string $name, string $description): InsertCategoryOutput
    {
        $category = $this->repo->readCategoryByName($name);

        if ($category) {
            throw new DomainException("category $name already exists");
        }

        $category = new Category($name, $description);

        $createdCategory = $this->repo->createCategory($category->name, $category->description);

        return new InsertCategoryOutput(
            $createdCategory->id,
            $createdCategory->name,
            $createdCategory->description,
        );
    }
}
