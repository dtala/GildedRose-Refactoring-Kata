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
            if ($item->name !== 'Aged Brie' && $item->name !== 'Backstage passes to a TAFKAL80ETC concert') {
                if (($item->quality > 0) && $item->name !== 'Sulfuras, Hand of Ragnaros') {
                    --$item->quality;
                }
            } else if ($item->quality < 50) {
                ++$item->quality;
                if ($item->name === 'Backstage passes to a TAFKAL80ETC concert') {
                    if (($item->sell_in < 11) && $item->quality < 50) {
                        ++$item->quality;
                    }
                    if (($item->sell_in < 6) && $item->quality < 50) {
                        ++$item->quality;
                    }
                }
            }

            if ($item->name !== 'Sulfuras, Hand of Ragnaros') {
                --$item->sell_in;
            }

            if ($item->sell_in < 0) {
                if ($item->name !== 'Aged Brie') {
                    if ($item->name !== 'Backstage passes to a TAFKAL80ETC concert') {
                        if (($item->quality > 0) && $item->name !== 'Sulfuras, Hand of Ragnaros') {
                            --$item->quality;
                        }
                    } else {
                        $item->quality -= $item->quality;
                    }
                } else if ($item->quality < 50) {
                    ++$item->quality;
                }
            }
        }
    }
}
