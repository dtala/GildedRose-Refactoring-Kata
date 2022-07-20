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
            if ($item->name === 'Aged Brie') {
                if ($item->quality < 50) {
                    ++$item->quality;
                }

                if ($item->sell_in <= 0 && $item->quality !== 50) {
                    ++$item->quality;
                }

                --$item->sell_in;

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

                --$item->sell_in;

            } elseif ($item->name === 'Sulfuras, Hand of Ragnaros') {
                // Legendary!
            } elseif (explode(' ', $item->name)[0] === 'Conjured') {
                $item->quality -= 2;
                --$item->sell_in;

                if ($item->sell_in <= 0) {
                    $item->quality -= 2;
                }
                break;
            } else {
                --$item->quality;
                --$item->sell_in;

                if ($item->sell_in <= 0) {
                    --$item->quality;
                }
            }
        }
    }
}
