<?php

use DDD\Modules\Customer\Business\App\Actions\AddCartItem\AddCartItemAction;
use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\CreateCartItemRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\GetCartByIdRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\GetItemByIdRepo;
use DDD\Modules\Customer\Business\Entities\Cart;
use DDD\Modules\Customer\Business\Entities\CartItem;
use DDD\Modules\Customer\Business\Types\ItemQuantity;
use DDD\Modules\Customer\Tests\CustomerTestRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class AddCartItemTest extends TestCase
{
    /** @test */
    public function itShouldAddItemToCart(): void
    {
        /** @var GetCartByIdRepo|GetItemByIdRepo|CreateCartItemRepo|MockObject $repo */
        $repo = $this->createStub(CustomerTestRepository::class);

        $cartItem = CartItem::createWithId('1', 'item', 50.00, '3', new ItemQuantity(5));

        $repo
            ->method('getItemById')
            ->willReturn($cartItem);

        $cart = new Cart('2');

        $repo
            ->method('getCartByIdRepo')
            ->willReturn($cart);

        $repo
            ->method('createCartItem')
            ->willReturn(true);

        $action = new AddCartItemAction($repo);

        $result = $action->execute($cartItem->id, $cart->id);
        
        $this->assertTrue($result);
    }

    /** @test */
    public function itShouldThrowExceptionIfItemDoesNotExist()
    {
        /** @var GetItemByIdRepo|MockObject $repo */
        $repo = $this->createStub(GetItemByIdRepo::class);

        $repo
            ->method('getItemById')
            ->willReturn(null);

        $action = new AddCartItemAction($repo);

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('item does not exist');

        $action->execute(1, 1);
    }

    /** @test */
    public function itShouldThrowExceptionIfCartDoesNotExist()
    {
        /** @var GetCartByIdRepo|GetItemByIdRepo|MockObject $repo */
        $repo = $this->createStub(CustomerTestRepository::class);

        $cartItem = CartItem::createWithId('1', 'cart item', 50.00, 1, new ItemQuantity(5));

        $repo
            ->method('getItemById')
            ->willReturn($cartItem);

        $repo
            ->method('getCartByIdRepo')
            ->willReturn(null);

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('cart does not exist');

        $action = new AddCartItemAction($repo);

        $action->execute($cartItem->id, 1);
    }
}
