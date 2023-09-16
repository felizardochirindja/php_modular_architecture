<?php

namespace DDD\Modules\Catalog\Business\App\Actions\updateProduct;

use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\ReadProductByIdRepo;
use DDD\Modules\Catalog\Business\App\Ports\Repo\Product\UpdateProductRepo;
use DDD\Modules\Catalog\Business\App\Actions\updateProduct\UpdateProductInput;
use DDD\Modules\Catalog\Business\App\Actions\updateProduct\UpdateProductOutput;
use DomainException;

final class UpdateProductAction
{
    public function __construct(
        private ReadProductByIdRepo|UpdateProductRepo $repo
    ){}

    public function execute(UpdateProductInput $input): UpdateProductOutput
    {
        $product = $this->repo->readProductById($input->productId);

        if (!$product) {
            throw new DomainException("product with id of $input->productId does not exist!");
        }

        $updatedProduct = $this->repo->updateProduct($input->productId, $product);
        $category = $updatedProduct->category;

        return new UpdateProductOutput(
            $updatedProduct->id,
            $updatedProduct->name,
            $updatedProduct->price,
            $category->id,
            $category->name,
            $category->description,
        );
    }
}
