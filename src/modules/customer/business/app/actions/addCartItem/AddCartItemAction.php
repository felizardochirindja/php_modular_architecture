<?php

namespace DDD\Modules\Customer\Business\App\Actions\AddCartItem;

use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\CreateCartItemRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\GetCartByIdRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\GetItemByIdRepo;
use DomainException;

final class AddCartItemAction
{
    public function __construct(
        private GetCartByIdRepo | GetItemByIdRepo | CreateCartItemRepo $repo,
    ) {}

    public function execute(int $itemId, int $cartId): bool
    {
        $item = $this->repo->getItemById($itemId);

        if (!$item) {
            throw new DomainException('item does not exist');
        }

        $cart = $this->repo->getCartByIdRepo($cartId);

        if (!$cart) {
            throw new DomainException('cart does not exist');
        }

        return $this->repo->createCartItem($cart->id, $item->id);
    }
}
