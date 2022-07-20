<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            if ($item->name === 'Sulfuras, Hand of Ragnaros') {
                continue;
            }

            if ($item->name === 'Aged Brie') {
                if ($item->quality < 50) {
                    ++$item->quality;
                }

                if ($item->sell_in <= 0 && $item->quality !== 50) {
                    ++$item->quality;
                }

            } elseif ($item->name === 'Backstage passes to a TAFKAL80ETC concert') {
                ++$item->quality;

                if ($item->sell_in <= 10) {
                    ++$item->quality;
                }

                if ($item->sell_in <= 5) {
                    ++$item->quality;
                }

                if ($item->quality > 50) {
                    $item->quality = 50;
                }

                if ($item->sell_in <= 0) {
                    $item->quality = 0;
                }

            } elseif (explode(' ', $item->name)[0] === 'Conjured') {
                $item->quality -= 2;

                if ($item->sell_in <= 0) {
                    $item->quality -= 2;
                }
            } else {
                --$item->quality;

                if ($item->sell_in <= 0) {
                    --$item->quality;
                }
            }

            --$item->sell_in;
        }
    }
}
