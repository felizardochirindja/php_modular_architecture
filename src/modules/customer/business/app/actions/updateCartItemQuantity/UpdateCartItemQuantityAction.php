<?php

namespace DDD\Modules\Customer\Business\App\Actions\UpdateCartItemQuantity;

use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\GetCartByIdRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\GetItemByIdRepo;
use DDD\Modules\Customer\Business\App\Ports\Repo\Cart\UpdateCartItemQuantityRepo;
use DomainException;

final class UpdateCartItemQuantityAction
{
    public function __construct(
        private GetCartByIdRepo | GetItemByIdRepo | UpdateCartItemQuantityRepo $repo,
    ) {}

    public function execute(int $itemId, int $cartId, int $quantity): bool
    {
        $item = $this->repo->getItemById($itemId);

        if (!$item) {
            throw new DomainException("item does not exist");
        }

        $cart = $this->repo->getCartByIdRepo($cartId);

        if (!$cart) {
            throw new DomainException("cart does not exist");
        }

        return $this->repo->updateCartItemQuantity($cartId, $itemId, $quantity);
    }
}
