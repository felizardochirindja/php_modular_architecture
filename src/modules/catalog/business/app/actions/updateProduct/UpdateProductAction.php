<?php

namespace DDD\Modules\Catalog\Business\App\Actions\updateProduct;

use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\ReadProductByIdRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\UpdateProductRepo;
use DDD\Modules\Catalog\Business\Entities\Product;
use DomainException;

final class UpdateProductAction
{
    public function __construct(
        private ReadProductByIdRepo|UpdateProductRepo $repo
    ){}

    public function execute(string $productId, Product $product)
    {
        $product = $this->repo->readProductById($productId);

        if (!$product) {
            throw new DomainException("product with id of $productId does not exist!");
        }

        $updatedProduct = $this->repo->updateProduct($productId, $product);

        $output = new UpdateProductOutput(
            $updatedProduct->id,
            $updatedProduct->name,
            $updatedProduct->price,
            $updatedProduct->category->id,
            $updatedProduct->category->name,
            $updatedProduct->category->description,
        );

        return $output;
    }
}
