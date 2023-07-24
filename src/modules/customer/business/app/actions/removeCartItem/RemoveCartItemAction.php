<?php

namespace DDD\Modules\Customer\Business\App\Actions\RemoveCartItem;

use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\GetCartByIdRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\GetItemByIdRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\RemoveCartItemRepo;
use DomainException;

final class RemoveCartItemAction
{
    public function __construct(
        private GetCartByIdRepo | GetItemByIdRepo | RemoveCartItemRepo $repo,
    ) {}

    public function execute(int $itemId, int $cartId): mixed
    {
        $item = $this->repo->getItemById($itemId);

        if (!$item) {
            throw new DomainException("item does not exist");
        }

        $cart = $this->repo->getCartByIdRepo($cartId);

        if (!$cart) {
            throw new DomainException("cart does not exist");
        }

        $this->repo->removeCartItem($cartId, $itemId);
    }
}
