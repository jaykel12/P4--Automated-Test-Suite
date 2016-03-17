<?php
//item_test.php
require_once 'simpletest/autorun.php';
include 'Item.php';

class ItemTest extends UnitTestCase {
    //tests food variable
	function testItem() {
        //create new item
        $food = new Item("Chicken","Fajita",2.00);
        //assertIdentical to check if values are the same
        $this->assertIdentical($food->name,"Chicken", "Food name = Chicken");
        $this->assertIdentical($food->description,"Fajita", "Description = Fajita");
        $this->assertIdentical($food->price,2.00, "Price = 2.00");
    
	}

}