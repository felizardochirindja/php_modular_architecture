<?php

namespace DDD\Modules\Catalog\Business\App\Actions\updateCategory;

use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\ReadCategoryByIdRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\UpdateCategoryRepo;
use DDD\Modules\Catalog\Business\Entities\Category;
use DomainException;

final class UpdateCategoryAction
{
    public function __construct(
        private ReadCategoryByIdRepo|UpdateCategoryRepo $repo,
    ){}

    public function __invoke(UpdateCategoryInput $input): UpdateCategoryOutput
    {
        $category = $this->repo->readCategoryById($input->categoryId);

        if (!$category) {
            throw new DomainException("category with id of $input->categoryId does not exist!");
        }

        $category = Category::createWihoutId($input->categoryName, $input->CategoryDescription);

        $updatedCategory = $this->repo->updateCategory($category);

        return new UpdateCategoryOutput(
            $updatedCategory->id,
            $updatedCategory->name,
            $updatedCategory->description,
        ); 
    }
}