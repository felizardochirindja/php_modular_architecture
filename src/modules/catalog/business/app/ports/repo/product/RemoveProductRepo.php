<?php

namespace DDD\Modules\Catalog\Business\App\Ports\Repo\Product;

interface RemoveProductRepo
{
    public function removeProduct(): bool;
}
