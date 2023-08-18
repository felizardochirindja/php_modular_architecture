<?php

namespace DDD\Modules\Catalog\Business\App\Actions\RemoveProduct;

use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\ReadProductByIdRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\RemoveProductRepo;
use DomainException;

class RemoveProductAction
{
    public function __construct(
        private RemoveProductRepo|ReadProductByIdRepo $repo
    ){}

    public function execute(string $productId): bool
    {
        $product = $this->repo->readProductById($productId);

        if (!$product) {
            throw new DomainException("product with id of $productId does not exist!");
        }

        $this->repo->removeProduct($productId);

        return true;
    }
}
