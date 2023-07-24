<?php

use DDD\Modules\Catalog\Business\App\Actions\ShowProducts\ShowProductsAction;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\CountProductsRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\ReadProductsRepo;
use DDD\Modules\Catalog\Tests\Unit\CatalogTestRepository;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

final class ShowProductsTest extends TestCase
{
    /** @test */
    public function itShouldShowProducts(): void
    {
        /** @var ReadProductsRepo|CountProductsRepo|MockObject $repo */
        $repo = $this->createStub(CatalogTestRepository::class);

        $repo
            ->method("countProducts")
            ->willReturn(1);

        $expectedProducts = [
            [
                'id' => '1',
                'name' => 'product',
                'description' => 'description',
            ]
        ];

        $repo
            ->method("readProducts")
            ->willReturn($expectedProducts);

        $action = new ShowProductsAction($repo);

        $products = $action->execute(1, 5);

        $this->assertEquals($expectedProducts, $products);
    }
}
