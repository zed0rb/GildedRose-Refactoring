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
}
