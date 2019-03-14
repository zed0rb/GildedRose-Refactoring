<?php

class GildedRose {

    private $items;

    function __construct($items) {
        $this->items = $items;
    }

    function update_quality() {
        foreach ($this->items as $item) {

            switch ($item->name) {
                case 'Aged Brie':
                    $item->quality += 1;
                    $item->sell_in -= 1;

                    if ($item->sell_in <= 0) {
                        $item->quality += 1;
                    }

                    if ($item->quality > 50) {
                        $item->quality = 50;
                    }

                    break;

                case  'Backstage passes to a TAFKAL80ETC concert':
                    $item->quality += 1;

                    if ($item->name <= 10) {
                        $item->quality += 1;
                    }

                    if ($item->name <= 5) {
                        $item->quality += 1;
                    }

                    if ($item->quality > 50) {
                        $item->quality = 50;
                    }

                    if ($item->sell_in <= 0) {
                        $item->quality = 0;
                    }

                    $item->sell_in -= 1;
                    break;

                case 'Sulfuras, Hand of Ragnaros':

                    // emty for reason
                    break;

                case 'Conjured Mana Cake':
                    $item->quality -= 2;
                    $item->sell_in -= 1;

                    if ($item->sell_in <= 0) {
                        $item->quality -= 2;
                    }

                    break;

                default:
                    $item->quality -= 1;
                    $item->sell_in -= 1;

                    if ($item->sell_in <= 0) {
                        $item->quality -= 1;
                    }

                    break;
            }

            if ($item->quality <= 0) {
                $item->quality = 0;
            }
        }
    }
}

class Item {

    public $name;
    public $sell_in;
    public $quality;

    function __construct($name, $sell_in, $quality) {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString() {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

}

