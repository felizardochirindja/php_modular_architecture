<?php

use DDD\Modules\Catalog\Business\App\Actions\InsertProduct\InsertProductAction;
use DDD\Modules\Catalog\Business\App\Actions\InsertProduct\InsertProductOutput;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\ReadCategoryByIdRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\CreateProductRepo;
use DDD\Modules\Catalog\Business\Entities\Category;
use DDD\Modules\Catalog\Business\Entities\Product;
use DDD\Modules\Catalog\Tests\CatalogTestRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class InsertProductActionTest extends TestCase
{
    /** @test */
    public function itShouldInsertProduct(): void
    {
        /** @var CreateProductRepo|ReadCategoryByIdRepo|MockObject $repo */
        $repo = $this->createStub(CatalogTestRepository::class);
        
        $category = Category::createWithId("2", "category", "description");
        $product = Product::createWith("1", "product", 50.00, $category);
        
        $repo
            ->method("createProduct")
            ->willReturn($product);
        
        $repo
            ->method("readCategoryById")
            ->willReturn($category);

        $action = new InsertProductAction($repo);
        $output = $action->execute($product->name, $product->price, $category->id);

        $expectedOuput = new InsertProductOutput(
            $product->id,
            $product->name,
            $product->price,
            $category->id,
            $category->name,
            $category->description,
        );

        $this->assertEquals($expectedOuput, $output);
    }

    /** @test */
    public function itShouldThrowExceptionIfCategoryDoesNotExist(): void
    {
        /** @var ReadCategoryByIdRepo|MockObject $repo */
        $repo = $this->createStub(ReadCategoryByIdRepo::class);

        $repo
            ->method("readCategoryById")
            ->willReturn(null);

        $action = new InsertProductAction($repo);

        $categoryId = 1;

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("category with id of " . $categoryId . " does not exist");
        
        $action->execute("product", 50.00, $categoryId);
    }
}
