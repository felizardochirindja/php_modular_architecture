<?php

use DDD\Modules\Customer\Business\App\Actions\UpdateCartItemQuantity\UpdateCartItemQuantityAction;
use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\GetCartByIdRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\GetItemByIdRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\UpdateCartItemQuantityRepo;
use DDD\Modules\Customer\Business\Entities\Cart;
use DDD\Modules\Customer\Business\Entities\CartItem;
use DDD\Modules\Customer\Business\Types\ItemQuantity;
use DDD\Modules\Customer\Tests\CustomerTestRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class UpdateCartItemQuantityActionTest extends TestCase
{
    /** @test */
    public function itShouldUpdateCartItemQuantity(): void
    {
        /** @var GetCartByIdRepo|GetItemByIdRepo|UpdateCartItemQuantityRepo|MockObject $repo */
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
            ->method('updateCartItemQuantity')
            ->willReturn(true);

        $action = new UpdateCartItemQuantityAction($repo);

        $result = $action->execute($cartItem->id, $cart->id, 5);

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

        $action = new UpdateCartItemQuantityAction($repo);

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('item does not exist');

        $action->execute(1, 1, 5);
    }

    /** @test */
    public function itShouldThrowExceptionIfCartDoesNotExist()
    {
        /** @var GetCartByIdRepo|GetItemByIdRepo|MockObject $repo */
        $repo = $this->createStub(CustomerTestRepository::class);

        $cartItem = CartItem::createWithId('1', 'cart item', 50.00, 1, new ItemQuantity(2));

        $repo
            ->method('getItemById')
            ->willReturn($cartItem);

        $repo
            ->method('getCartByIdRepo')
            ->willReturn(null);

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('cart does not exist');

        $action = new UpdateCartItemQuantityAction($repo);

        $action->execute($cartItem->id, 1, 5);
    }
}
