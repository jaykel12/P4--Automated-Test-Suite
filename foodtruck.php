<?php 
/**
 * foodtruck.php 
 * Outputs a form with menu items for user to select.
 * Via postback takes user selected items calculates then outputs total cost
 * Uses Item.php to create menu objects that includes name, description, and price
 *
 * @package foodtruck
 * @authorA: Paul Mansoor: <paul.mansoor@gmail.com>
 * @authorB: Mitchell Thompson <thomitchell@gmail.com>
 * @authorC: JayKel Torres <jaykel123abc@gmail.com>
 * @version 1.0 2016/01/30 
 * @link http://www.mitchlthompson.com/itc250/sandbox/foodtruck.php 
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @see item.php
 * @todo none
 */


define('THIS_PAGE', basename($_SERVER['PHP_SELF']));

//includes class to create menu items
include 'Item.php';

//create three Item objects for menu items 
$pizza = new Item("Pizza","Delicious slices with your choice of toppings",5.99);
$salad = new Item("Salad","Romaine lettuce with cheese, tomato, and crutons",4.99);
$brownie = new Item("Brownie","Gooey and chewy chocolate brownies",3.99);


if(isset($_POST['submit']))
{//data submitted
    
    //var for number of pizza slices user selected
    $numSlices = $_POST['numSlices'];
    
    //var for number of brownies user selected
    $brownies = $_POST['brownies'];
    
    //var for number of salads user selected
    $salads = $_POST['salads'];
    
    //var for the array of toppings user selected
    $topping = $_POST['topping'];
    
    //* number of selected items by that item's price in that instance of the Item object
    $subTotal = ($numSlices * $pizza->price) + ($brownies * $brownie->price) + ($salads * $salad->price);
    
    //+ to $total the price of toppings (.25) * by size of $topping array (# of toppings user selected)
    $subTotal += .25 * sizeof($topping);
    
    //var for salestax
    $salesTax = .09;
    
    //var for computing sales tax then adding with subtotal to get total order cost
    $total = ($subTotal * $salesTax) + $subTotal;
    
    //start intro output for user
    echo 'Your order includes: <br/><br/>';
    
    //following if/else statements handle what to do with pizza and selected toppings
    //if user selected 1 or more slices of pizza AND toppings step into the IF statment
    if ($numSlices != 0 and sizeof($topping) != 0) {
        
        //initialize empty string for toppings
        $toppings = '';
        
        //loop though $topping array then create a string that includes a line break and each topping
        foreach($topping as $topps) {
              $toppings .= '<br>' . $topps; 
        }
        
        //then if number of slices user selected is one output message to user, else include "slices" 
        if ($numSlices == 1){
        echo $numSlices . ' slice of Pizza topped with: ' . $toppings . '<br/>';
        }else {
        echo $numSlices . ' slices of Pizza topped with: ' . $toppings . '<br/>';
        }
    
    //else if no toppings selected and one slice slected then output message
    }else if($numSlices == 1){
        echo $numSlices . ' slice of Pizza topped with no toppings<br/>'; 
    
    //else if no toppings selected with more than one slice selected then output message
    }else if($numSlices != 1){
        echo $numSlices . ' slices of Pizza topped with no toppings<br/>'; 
    }
    
    //if brownies selected than output # of brownies selected with message
    if ($brownies != 0) {
        echo $brownies . ' side brownies<br/>';
    }
    
    //if salads selected than output # of salads selected with message
    if ($salads != 0) {
        echo $salads . ' side salads<br/>';
    }
    
    //output subtotal, sales tax amount, and total cost of order
    echo '<br/>Subtotal: $' . round($subTotal,2);
    echo '<br/>Sales Tax: $' . round(($subTotal * $salesTax),2);
    echo '<br/>The total for the order is $' .  round($total,2);
    
}else{//show form
    echo '
    <form method="post" action="' . THIS_PAGE . '">
    <fieldset name="pizza">
    <legend>Pizza</legend>
    <br/>Description: ' . $pizza->description   . '.<br/>
    <br/>Price: $' . $pizza->price   . '<br/><br/>
    
    How many slices?<br/>
    <select name="numSlices">
    <option value="0">zero</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
    </select><br /><br />
    
    Select toppings:<br />
    <input type="checkbox" name="topping[]" value="Pepperoni">Pepperoni<br/>
    <input type="checkbox" name="topping[]" value="Salami">Salami<br/>
    <input type="checkbox" name="topping[]" value="Pineapple">Pineapple<br/>
    <input type="checkbox" name="topping[]" value="Sausage">Sausage<br/>
    <input type="checkbox" name="topping[]" value="Mushroom">Mushroom<br/>
    </select><br />
    
    </fieldset>
    
    <fieldset name="Sides">
    <legend>Sides</legend>
    
    Salad<br />
    <br/>Description: ' . $salad->description   . '.<br/>
    <br/>Price: $' . $salad->price   . '<br/><br/>
    <select name="salads">
    <option value="0">zero</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
    </select><br /><br /><br />
    
    Brownie<br />
    <br/>Description: ' . $brownie->description   . '.<br/>
    <br/>Price: $' . $brownie->price   . '<br/><br/>
    <select name="brownies">
    <option value="0">zero</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
    </select><br /><br />
    </fieldset>
    <br />
    <input type="submit" name="submit" value="Submit It!" />
    </form>
    ';
}