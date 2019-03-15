<?php
use PHPUnit\Framework\TestCase;
require_once 'gilded_rose.php';

class GildedRoseTest extends TestCase {

    function testFoo() {
        $items = array(new Item("foo", 0, 0));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals("foo", $items[0]->name);
    }
    function test_aged_brie_before_sell_in_date_updates_normally() {
        $items = array(new Item("Aged Brie", 10, 10));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 11);
        $this->assertEquals($items[0]->sell_in, 9);
    }

    function test_aged_brie_on_sell_in_date_updates_normally() {
        $items = array(new Item("Aged Brie", 0, 10));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 12);
        $this->assertEquals($items[0]->sell_in, -1);
    }

    function test_aged_brie_after_sell_in_date_updates_normally() {
        $items = array(new Item("Aged Brie", -5, 10));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 12);
        $this->assertEquals($items[0]->sell_in, -6);
    }

    function test_aged_brie_before_sell_in_date_with_maximum_quality() {
        $items = array(new Item("Aged Brie", 5, 50));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 50);
        $this->assertEquals($items[0]->sell_in, 4);
    }

    function test_aged_brie_on_sell_in_date_near_maximum_quality() {
        $items = array(new Item("Aged Brie", 0, 49));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 50);
        $this->assertEquals($items[0]->sell_in, -1);
    }

    function test_aged_brie_on_sell_in_date_with_maximum_quality() {
        $items = array(new Item("Aged Brie", 0, 50));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 50);
        $this->assertEquals($items[0]->sell_in, -1);
    }

    function test_aged_brie_after_sell_in_date_with_maximum_quality() {
        $items = array(new Item("Aged Brie", -10, 50));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 50);
        $this->assertEquals($items[0]->sell_in, -11);
    }

    function test_backstage_pass_before_sell_on_date_updates_normally() {
        $items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 10, 10));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 12);
        $this->assertEquals($items[0]->sell_in, 9);
    }

    function test_backstage_pass_more_than_ten_days_before_sell_on_date_updates_normally() {
        $items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 11, 10));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 11);
        $this->assertEquals($items[0]->sell_in, 10);
    }

    function test_backstage_pass_updates_by_three_with_five_days_left_to_sell() {
        $items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 5, 10));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 13);
        $this->assertEquals($items[0]->sell_in, 4);
    }

    function test_backstage_pass_drops_to_zero_after_sell_in_date() {
        $items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 0, 10));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 0);
        $this->assertEquals($items[0]->sell_in, -1);
    }

    function test_backstage_pass_close_to_sell_in_date_with_max_quality() {
        $items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 10, 50));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 50);
        $this->assertEquals($items[0]->sell_in, 9);
    }

    function test_backstage_pass_very_close_to_sell_in_date_with_max_quality() {
        $items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 5, 50));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 50);
        $this->assertEquals($items[0]->sell_in, 4);
    }

    function test_backstage_pass_quality_zero_after_sell_date() {
        $items = array(new Item("Backstage passes to a TAFKAL80ETC concert", -5, 50));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 0);
        $this->assertEquals($items[0]->sell_in, -6);
    }

    function test_sulfuras_before_sell_in_date() {
        $items = array(new Item("Sulfuras, Hand of Ragnaros", 10, 10));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 10);
        $this->assertEquals($items[0]->sell_in, 10);
    }

    function test_sulfuras_on_sell_in_date() {
        $items = array(new Item("Sulfuras, Hand of Ragnaros", 0, 10));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 10);
        $this->assertEquals($items[0]->sell_in, 0);
    }

    function test_sulfuras_after_sell_in_date() {
        $items = array(new Item("Sulfuras, Hand of Ragnaros", -1, 10));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 10);
        $this->assertEquals($items[0]->sell_in, -1);
    }

    function test_conjured_before_sell_in_date_updates_normally() {
        $items = array(new Item("Conjured Mana Cake", 10, 10));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 8);
        $this->assertEquals($items[0]->sell_in, 9);
    }

    function test_conjured_does_not_degrade_passed_zero() {
        $items = array(new Item("Conjured Mana Cake", 10, 0));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 0);
        $this->assertEquals($items[0]->sell_in, 9);
    }

    function test_conjured_after_sell_in_date_degrades_twice_as_fast() {
        $items = array(new Item("Conjured Mana Cake", 0, 10));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 6);
        $this->assertEquals($items[0]->sell_in, -1);
    }

    function test_normal_items_before_sell_in_date_updates_normally() {
        $items = array(new Item("+5 Dexterity Vest", 10, 10));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 9);
        $this->assertEquals($items[0]->sell_in, 9);
    }

    function test_normal_items_on_sell_in_date_quality_degrades_twice_as_fast() {
        $items = array(new Item("+5 Dexterity Vest", 0, 10));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 8);
        $this->assertEquals($items[0]->sell_in, -1);
    }

    function test_normal_items_after_sell_in_date_quality_degrades_twice_as_fast() {
        $items = array(new Item("+5 Dexterity Vest", -1, 10));
        $gildedRose = new GildedRose($items);
        $gildedRose->update_quality();
        $this->assertEquals($items[0]->quality, 8);
        $this->assertEquals($items[0]->sell_in, -2);
    }
}
