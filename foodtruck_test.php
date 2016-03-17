<?php
//foodtruck_test.php
include_once 'includes/settings.php';
require_once 'simpletest/autorun.php';
require_once 'simpletest/web_tester.php';

class FoodTruckTests extends WebTestCase {
    
    //test food truck submit
	  function testFoodTruck() {
          
		$this->get(VIRTUAL_PATH . '/foodtruck.php');
		$this->assertResponse(200);
          
        //insert value into numSlices
        $this->setField("numSlices", 3);
        //insert value into salads
        $this->setField("salads", 2);
        //insert value into brownies
        $this->setField("brownies", 1);
        //submit it
		$this->clickSubmit("Submit It!");
          
        //test for text after submition
		$this->assertResponse(200);
		$this->assertText("Your order includes:");
        $this->assertText("3 slices of Pizza topped with no toppings");
        $this->assertText("2 side salads");
        $this->assertText("1 side brownies"); 
        $this->assertText("Subtotal: $31.94");
        $this->assertText("Sales Tax: $2.87");
        $this->assertText("The total for the order is $34.81");  
        
	}

}