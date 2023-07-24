<?php

use DDD\Modules\Catalog\Business\App\Actions\showProductsByCategory\ShowProductsByCategoryAction;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\ReadCategoryByIdRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\CountProductsRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\ReadProductsByCategoryIdRepo;
use DDD\Modules\Catalog\Business\Entities\Category;
use DDD\Modules\Catalog\Tests\Unit\CatalogTestRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class ShowProductsByCategoryTest extends TestCase
{
    /** @test */
    public function itShouldShowProductsByCategory(): void
    {
        /** @var ReadCategoryByIdRepo|CountProductsRepo|ReadProductsByCategoryIdRepo|MockObject $repo */
        $repo = $this->createStub(CatalogTestRepository::class);

        $repo
            ->method('countProducts')
            ->willReturn(1);

        $category = Category::createWithId('1', 'category', 'description');

        $repo
            ->method('readCategoryById')
            ->willReturn($category);

        $expectedProducts = [
            [
                'id' => '1',
                'name' => 'product',
                'description' => 'description',
            ]
        ];

        $repo
            ->method('readProductsByCategoryId')
            ->willReturn($expectedProducts);

        $action = new ShowProductsByCategoryAction($repo);

        $products = $action->execute(1, 1, 5);

        $this->assertSame($expectedProducts, $products);
    }

    /** @test */
    public function itShouldThrowExceptionIfCategoryDoesNotExist(): void
    {
        /** @var ReadCategoryByIdRepo|CountProductsRepo|MockObject $repo */
        $repo = $this->createStub(CatalogTestRepository::class);

        $repo
            ->method('countProducts')
            ->willReturn(1);

        $repo
            ->method('readCategoryById')
            ->willReturn(null);

        $action = new ShowProductsByCategoryAction($repo);

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('category with id of 1 does not exist!');

        $action->execute(1, 1, 5);
    }
}
