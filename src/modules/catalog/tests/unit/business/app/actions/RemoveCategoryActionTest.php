<?php

use DDD\Modules\Catalog\Business\App\Actions\RemoveCategory\RemoveCategoryAction;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\ReadCategoryByIdRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\RemoveCategoryRepo;
use DDD\Modules\Catalog\Business\Entities\Category;
use DDD\Modules\Catalog\Tests\Unit\CatalogTestRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RemoveCategoryActionTest extends TestCase
{
    /** @test */
    public function itShouldRemoveCategory()
    {
        /** @var RemoveCategoryRepo|ReadCategoryByIdRepo|MockObject $repo */
        $repo = $this->createStub(CatalogTestRepository::class);

        $category = Category::createWihoutId('category', 'description');

        $repo
            ->method('readCategoryById')
            ->willReturn($category);

        $repo
            ->method('removeCategory')
            ->willReturn(true);

        $action = new RemoveCategoryAction($repo);

        $result = $action(1);

        $this->assertTrue($result);
    }
}
