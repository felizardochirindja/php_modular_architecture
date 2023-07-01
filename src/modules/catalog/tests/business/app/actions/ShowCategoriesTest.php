<?php

use DDD\Modules\Catalog\Business\App\Actions\ShowCategories\ShowCategoriesAction;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\CountCategoriesRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Category\ReadCategoriesRepo;
use DDD\Modules\Catalog\Tests\CatalogTestRepository;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

final class ShowCategoriesTest extends TestCase
{
    /** @test */
    public function itShouldShowCategories(): void
    {
        /** @var ReadCategoriesRepo|CountCategoriesRepo|MockObject $repo */
        $repo = $this->createStub(CatalogTestRepository::class);

        $repo
            ->method("countCategories")
            ->willReturn(1);

        $expectedCategories = [
            [
                'id' => '1',
                'name' => 'category',
                'description' => 'description',
            ],
        ];

        $repo
            ->method("readCategories")
            ->willReturn($expectedCategories);

        $action = new ShowCategoriesAction($repo);

        $categories = $action->execute(1, 5);

        $this->assertEquals($expectedCategories, $categories);
    }
}
