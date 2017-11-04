<?php
/**
 * Created by PhpStorm.
 * User: karti
 * Date: 01-Nov-17
 * Time: 3:41 PM
 */
include 'dbconfig.php';
session_start();
if (isset($_SESSION['cart']))
    $cart = $_SESSION['cart'];
else
    $cart = [];
$total;
if(isset($_POST['add']) && $_POST['add'] != 2) {
    $id = $_POST['id'];
    $no = $_POST['quantity'];
    if ($_POST['add'] == 1)
        addToCart($id, $no);
    elseif ($_POST['add'] == 0)
        removeFromCart($id);
}
showCart();
function addToCart($item_id,$quantity){
    global $mysqli,$cart;
    $sql = "SELECT * FROM menu WHERE item_id=$item_id";
    if (!$mysqli->query($sql))
        echo $mysqli->error;
    $res = $mysqli->query($sql);
    $row = $res->fetch_assoc();
    if (array_key_exists($item_id,$cart)){
        $cart[$item_id][2] = $quantity;
        $cart[$item_id][3] = $cart[$item_id][1] * $quantity;
        echo "key already exists";
        $_SESSION['cart'] = $cart;
        return;
    }
    $total = $row['cost']*$quantity;
    $arr = array($row['item_id'] => array($row['Name'],$row['cost'],$quantity,$total));
    $cart = $cart + $arr;
    $_SESSION['cart'] = $cart;
}
function removeFromCart($id){
    global $cart;
    if (array_key_exists($id,$cart)){
        $cart[$id][2]--;
        if ($cart[$id][2] == '0') {
            unset($cart[$id]);
        }
        }
        else
            return;
        $_SESSION['cart'] = $cart;
}
function showCart(){
    global $cart,$total;
    if (count($cart) == 0) {
        echo "No items in the cart";
    }
    else {
        $html = <<<EOT
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Cost</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
EOT;
        $total = 0;
        foreach($cart as $key=>$value){
            $html .= <<<EOT
            <tr value="{$key}">
                <th>{$value[0]}</th>
                <th>{$value[1]}</th>
                <th>{$value[2]}</th>
                <th>{$value[3]}</th>
            </tr>          
EOT;
            $total += $value[3];
        }
        $html .= "<tr><th>Total:{$total}</th></tr></tbody></table>";
        $html .= "<button class='btn btn-danger' id='place-order'>Place Order</button>";
        echo $html;
    }
}
//TODO: place in orders table and use trigger to update into table
function placeOrder(){

}
//TODO: allow for customer to view currently placed order
function viewOrder(){

}
//TODO: using cookies generate a bill and allow for payment online
//TODO: use an SQL procedure somewhere
function generateBill(){

}
