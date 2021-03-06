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
                    ++$item->quality;
                    --$item->sell_in;

                    if ($item->sell_in <= 0) {
                        ++$item->quality;
                    }

                    break;

                case  'Backstage passes to a TAFKAL80ETC concert':
                    ++$item->quality;

                    if ($item->sell_in <= 10) {
                        ++$item->quality;
                    }

                    if ($item->sell_in <= 5) {
                        ++$item->quality;
                    }

                    if ($item->sell_in <= 0) {
                        $item->quality = 0;
                    }

                    --$item->sell_in;
                    break;

                case 'Sulfuras, Hand of Ragnaros':

                    // emty for reason
                    break;

                case 'Conjured Mana Cake':
                    $item->quality -= 2;
                    --$item->sell_in;

                    if ($item->sell_in <= 0) {
                        $item->quality -= 2;
                    }

                    break;

                default:
                    --$item->quality;
                    --$item->sell_in;

                    if ($item->sell_in <= 0) {
                        --$item->quality;
                    }

                    break;
            }

            if ($item->quality <= 0) {
                $item->quality = 0;
            }

            if ($item->name != 'Sulfuras, Hand of Ragnaros'){
                if ($item->quality > 50) {
                    $item->quality = 50;
                }
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

