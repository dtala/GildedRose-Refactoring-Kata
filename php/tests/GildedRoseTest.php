<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function test_aged_brie_increases_quality_by_two_after_sell_in_date(): void
    {
        $items = [new Item('Aged Brie', -1, 5)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(-2, $items[0]->sell_in);
        $this->assertSame(7, $items[0]->quality);
    }

    public function test_aged_brie_increases_quality_by_one_before_sell_in_date(): void
    {
        $items = [new Item('Aged Brie', 2, 5)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(1, $items[0]->sell_in);
        $this->assertSame(6, $items[0]->quality);
    }

    public function test_aged_brie_increases_quality_by_two_on_sell_in_date(): void
    {
        $items = [new Item('Aged Brie', 0, 5)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(7, $items[0]->quality);
    }

    public function test_aged_brie_quality_never_increases_max_value_after_sell_in_date(): void
    {
        $items = [new Item('Aged Brie', -1, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(-2, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    public function test_aged_brie_quality_never_increases_max_value_on_sell_in_date(): void
    {
        $items = [new Item('Aged Brie', 0, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    public function test_aged_brie_quality_never_increases_max_value_before_sell_in_date(): void
    {
        $items = [new Item('Aged Brie', 5, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(4, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

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

    public function test_backstage_pass_quality_increase_by_two_on_ten_or_less_sell_in_date(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame(12, $items[0]->quality);
    }

    public function test_backstage_pass_quality_increase_by_three_on_five_or_less_sell_in_date(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(4, $items[0]->sell_in);
        $this->assertSame(13, $items[0]->quality);
    }

    public function test_backstage_pass_quality_drop_to_zero_after_sell_in_date(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(0, $items[0]->quality);
    }

    public function test_backstage_pass_quality_increase_by_one_when_sell_in_date_above_ten(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 12, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(11, $items[0]->sell_in);
        $this->assertSame(11, $items[0]->quality);
    }

    public function test_backstage_pass_quality_never_surpasses_max_value_above_ten_sell_in_days(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 12, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(11, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    public function test_backstage_pass_quality_never_surpasses_max_value_below_ten_sell_in_days(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    public function test_backstage_pass_quality_never_surpasses_max_value_below_five_sell_in_days(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 48)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(4, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    public function test_conjured_item_before_sell_in_date_lowers_quality_twice_as_fast_as_normal_items(): void
    {
        $items = [new Item('Conjured water', 10, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame(8, $items[0]->quality);
    }

    public function test_conjured_item_after_sell_in_date_quality_lowers_twice_as_fast_as_normal_items(): void
    {
        $items = [new Item('Conjured bread', -1, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(-2, $items[0]->sell_in);
        $this->assertSame(6, $items[0]->quality);
    }

    public function test_conjured_item_on_sell_in_date_quality_lowers_twice_as_fast_as_normal_items(): void
    {
        $items = [new Item('Conjured Mana Cake', 0, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(6, $items[0]->quality);
    }
}
