<?php

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ShowCartActionTest extends TestCase
{
    /** @test */
    public function itShouldShowCart(): void
    {
        /** @var ReadCartByIdRepo|MockObject $repo */
        $repo = $this->createStub(ReadCartByIdRepo::class);

        $expectedCartItems = new ShowCartOutput(
            [
                'name' => 'user',
                'total_of_items' => 1,
            ],
            [
                [
                    'id' => '1',
                    'name' => 'product 1',
                    'price' => 50.00,
                    'category' => 'category',
                ],
                [
                    'id' => '2',
                    'name' => 'product 2',
                    'price' => 60.00,
                    'category' => 'category',
                ],
            ],
        );

        $repo
            ->method('readCartById')
            ->willReturn($expectedCartItems);

        $action = new ShowCartAction($repo);

        $cartId = 1;
        $cartItems = $action->execute($cartId);

        $this->assertSame($expectedCartItems, $cartItems);
    }
}
