<?php

use DDD\Modules\Catalog\Business\App\Actions\updateProduct\UpdateProductAction;
use DDD\Modules\Catalog\Business\App\Actions\updateProduct\UpdateProductOutput;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\ReadProductByIdRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\UpdateProductRepo;
use DDD\Modules\Catalog\Business\Entities\Category;
use DDD\Modules\Catalog\Business\Entities\Product;
use DDD\Modules\Catalog\Business\Types\ProductPrice;
use DDD\Modules\Catalog\Tests\Unit\CatalogTestRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UpdateProductActionTest extends TestCase
{
    /** @test */
    public function itShouldUpdateProduct()
    {
        /** @var UpdateProductRepo|ReadProductByIdRepo|MockObject $repo */
        $repo = $this->createStub(CatalogTestRepository::class);

        $product = Product::createWith(
            '1', 'product', new ProductPrice(50.00),
            Category::createWithId('2', 'category', 'description')
        );

        $repo
            ->method('readProductById')
            ->willReturn($product);
        
            $repo
            ->method('updateProduct')
            ->willReturn($product);

        $action = new UpdateProductAction($repo);

        $output = $action->execute($product->id, $product);

        $expectedOutput = new UpdateProductOutput(
            $product->id,
            $product->name,
            $product->price,
            $product->category->id,
            $product->category->name,
            $product->category->description,
        );

        $this->assertEquals($expectedOutput, $output);
    }

    /** @test */
    public function itShouldThrowExceptionIfProductDoesNotExist()
    {
        /** @var ReadProductByIdRepo|MockObject $repo */
        $repo = $this->createStub(ReadProductByIdRepo::class);

        $repo
            ->method('readProductById')
            ->willReturn(null);

        $action = new UpdateProductAction($repo);

        $product = Product::createWith(
            '1', 'product', new ProductPrice(50.00),
            Category::createWithId('2', 'category', 'description')
        );

        $this->expectException(DomainException::class);

        $action->execute($product->id, $product);
    }
}
