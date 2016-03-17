<?php
/**
* Item.php
*
* Class to create objects for menu items with name, description, and price fields
*
*<code>
* $myItem = new Item('Food', 'This food comes hot and ready',3.99);
*</code>
*
* @see RelatedClass
* @todo none
*/

class Item{
    public $name = '';
    public $description = '';
    public $price = 0;
    
    public function __construct($name, $description, $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }
    
}
