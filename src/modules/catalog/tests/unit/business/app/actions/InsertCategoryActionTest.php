<?php

use DDD\Modules\Catalog\Business\App\Actions\InsertCategory\InsertCategoryAction;
use DDD\Modules\Catalog\Business\App\Actions\InsertCategory\InsertCategoryOutput;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\CreateCategoryRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\ReadCategoryByNameRepo;
use DDD\Modules\Catalog\Business\Entities\Category;
use DDD\Modules\Catalog\Tests\Unit\CatalogTestRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class InsertCategoryActionTest extends TestCase
{
    /** @test */
    public function itShouldThrowExceptionIfCategoryAlreadyExists(): void
    {
        /** @var ReadCategoryByNameRepo|MockObject $repo */
        $repo = $this->createStub(ReadCategoryByNameRepo::class);
        
        $category = Category::createWihoutId("category", "description");

        $repo
        ->method('readCategoryByName')
        ->willReturn($category);
        
        $action = new InsertCategoryAction($repo);

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("category $category->name already exists");
        
        $action->execute($category->name, $category->description);
    }

    /** @test */
    public function itShouldCreateCategory(): void
    {
        /** @var ReadCategoryByNameRepo|CreateCategoryRepo|MockObject $repo */
        $repo = $this->createStub(CatalogTestRepository::class);
        
        $repo
            ->method('readCategoryByName')
            ->willReturn(null);
        
        $category = Category::createWithId('1', 'category', 'description');

        $repo
            ->method('createCategory')
            ->willReturn($category);

        $action = new InsertCategoryAction($repo);

        /** @var InsertCategoryOutput $output */
        $actualOutput = $action->execute($category->name, $category->description);

        $expectedOutput = new InsertCategoryOutput($category->id, $category->name, $category->description);
        $this->assertEquals($expectedOutput, $actualOutput);
    }
}
