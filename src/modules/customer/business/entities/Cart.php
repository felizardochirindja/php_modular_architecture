<?php

namespace DDD\Modules\Customer\Business\Entities;

final readonly class Cart
{
    /** @param CartItem[] $items */
    private ?array $items;

    public function __construct(
        public ?string $id,
    ) {}

    public function addItem(CartItem $item): void
    {
        array_push($this->items, $item);
    }

    public function showItems(): array
    {
        return $this->items;
    }
}
