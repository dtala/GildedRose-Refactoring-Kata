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

            } elseif ($item->name === 'Backstage passes to a TAFKAL80ETC concert') { // TODO simplify
                if ($item->sell_in <= 0) {
                    $item->quality = 0;
                } else if ($item->sell_in > 11 && $item->quality < 50) {
                    ++$item->quality;
                } else if ($item->sell_in > 5 && $item->sell_in < 11) {
                    if ($item->quality < 49) {
                        $item->quality += 2;
                    } else {
                        $item->quality = 50;
                    }
                } else if ($item->sell_in <= 5) {
                    if ($item->quality < 48) {
                        $item->quality += 3;
                    } else {
                        $item->quality = 50;
                    }
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
