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
$order = rand(1,100);
if(isset($_POST['add']) && $_POST['add'] != 2) {
    $id = $_POST['id'];
    $no = $_POST['quantity'];
    if ($_POST['add'] == 1)
        addToCart($id, $no);
    elseif ($_POST['add'] == 0)
        removeFromCart($id);
}
if(isset($_POST['place_ord'])){
    if(isset($_POST['pref']))
        placeOrder($order,$_POST['pref']);
    else
        placeOrder($order," ");
    exit();
}
if (isset($_POST['viewOrd'])){
    viewOrder();
    exit();
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
        $html .= "<textarea  rows='3' placeholder='preferences....' name='pref' id='pref' class='form-control'/><br>";
        $html .= "<button class='btn btn-danger' id='place-order'>Place Order</button>";
        echo $html;
    }
}
//TODO: place in orders table and use trigger to update into table
function placeOrder($ord_id,$pref){
    global $mysqli,$cart;
    if(!isset($_SESSION['tableno'])) {
        echo "0 You cannot place an order until you book a table";
        return;
    }
    foreach ($cart as $key=>$value){
        $sql = "INSERT INTO orders VALUES($ord_id,$key,3,{$_SESSION['tableno']},1,'$pref',$value[2],$value[3])";
        if ($mysqli->query($sql))
            echo "1";
        else
            echo $mysqli->error;
    }
}
//TODO: allow for customer to view currently placed order
function viewOrder(){
    global $mysqli;
    $q = "SELECT order_no FROM orders WHERE table_no={$_SESSION['tableno']} GROUP BY order_no";
    $result = $mysqli->query($q);
    $html = "";
    while($row = $result->fetch_assoc()){
        $total = 0;
        $sql = "SELECT * FROM orders WHERE table_no={$_SESSION['tableno']} AND order_no={$row['order_no']}";
        $res = $mysqli->query($sql);

        $html .= <<<EOT
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
<div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">{$row['order_no']}</a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse">
      <div class="panel-body">
<table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Total</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
EOT;
        while($rows = $res->fetch_assoc()){
            $q1 = "SELECT Name FROM menu WHERE item_id={$rows['item_id']}";
            $r = $mysqli->query($q1);
            $name = $r->fetch_array()[0];
            $total += $rows['cost'];
            $html .= <<<EOT
            <tr>
                <th>{$name}</th>
                <th>{$rows['cost']}</th>
                <th>{$rows['quantity']}</th>
            </tr>
EOT;
        }
        $html .= <<<EOT
        <tr><th>Total:{$total}</th></tr>
        </tbody>
        </table>
</div>
    </div>
</div>
EOT;
    }
    $html .= "</div><br><a href='billing.php'><button class='btn btn-done'>Pay and leave</button></a>";
    echo $html;
}
//TODO: use an SQL procedure somewhere
