<?php

use DDD\Modules\Catalog\Business\App\Actions\RemoveProduct\RemoveProductAction;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\ReadProductByIdRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\RemoveProductRepo;
use DDD\Modules\Catalog\Business\Entities\Category;
use DDD\Modules\Catalog\Business\Entities\Product;
use DDD\Modules\Catalog\Tests\Unit\CatalogTestRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RemoveProductActionTest extends TestCase
{
    /** @test */
    public function itShouldRemoveAProduct()
    {
        /** @var RemoveProductRepo|ReadProductByIdRepo|MockObject $repo */
        $repo = $this->createStub(CatalogTestRepository::class);

        $product = Product::createWithoutId(
            '1', 50.00, 
            Category::createWihoutId('category', 'description')
        );

        $repo
            ->method('readProductById')
            ->willReturn($product);

        $action = new RemoveProductAction($repo);

        $result = $action->execute(1);

        $this->assertTrue($result);
    }

    /** @test */
    public function itShouldThrowExceptionIfProductDoesNotExist()
    {
        /** @var ReadProductByIdRepo|MockObject $repo */
        $repo = $this->createStub(ReadProductByIdRepo::class);

        $repo
            ->method('readProductById')
            ->willReturn(null);

        $action = new RemoveProductAction($repo);

        $product = Product::createWith(
            '1', 'product', 50.00,
            Category::createWithId('2', 'category', 'description')
        );

        $this->expectException(DomainException::class);

        $action->execute($product->id, $product);
    }
}