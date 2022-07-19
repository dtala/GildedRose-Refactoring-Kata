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

    public function test_standard_item_before_sell_in_date_lowers_both_values_by_one(): void
    {
        $items = [new Item('Elixir of the Mongoose', 10, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame(9, $items[0]->quality);
    }

    public function test_standard_item_after_sell_in_date_quality_lowers_twice_as_fast(): void
    {
        $items = [new Item('Elixir of the Mongoose', -1, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(-2, $items[0]->sell_in);
        $this->assertSame(8, $items[0]->quality);
    }

    public function test_standard_item_on_sell_in_date_quality_lowers_twice_as_fast(): void
    {
        $items = [new Item('Elixir of the Mongoose', 0, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(8, $items[0]->quality);
    }
}
