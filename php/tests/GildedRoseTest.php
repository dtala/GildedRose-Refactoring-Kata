<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
//    public function testFoo(): void
//    {
//        $items = [new Item('foo', 0, 0)];
//        $gildedRose = new GildedRose($items);
//        $gildedRose->updateQuality();
//        $this->assertSame('fixme', $items[0]->name);
//    }

    public function test_sulfuras_before_sell_in_date(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 1, 80)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(1, $items[0]->sell_in);
        $this->assertSame(80, $items[0]->quality);
    }

    public function test_sulfuras_after_sell_in_date(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', -1, 80)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(80, $items[0]->quality);
    }

    public function test_sulfuras_on_sell_in_date(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 0, 80)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->sell_in);
        $this->assertSame(80, $items[0]->quality);
    }
}
