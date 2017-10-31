<?php
/**
 * Created by PhpStorm.
 * User: kartik
 * Date: 30-Oct-17
 * Time: 9:19 PM
 * @property  mysqli
 */
//TODO: add menu functionality
class menu
{
    private $mysqli;
    public function __construct($db){
        $this->mysqli = $db;
    }
    public function loadAll(){
        global $mysqli;
        $query = "SELECT * FROM menu";
        $result = $mysqli->query($query);
        $html = '';
        while ($row = $result->fetch_assoc()){
            
        }
    }
    public function loadBurgers(){
        global $mysqli;
        $query = "SELECT * FROM menu WHERE category LIKE '%Burgers'";
        $result = $mysqli->query($query);
        $html = '';
        while ($row = $result->fetch_assoc()){

        }
    }
    public function loadDosa(){
        global $mysqli;
        $query = "SELECT * FROM menu WHERE category LIKE '%Dosa'";
        $result = $mysqli->query($query);
        $html = '';
        while ($row = $result->fetch_assoc()){

        }
    }
    public function loadBeverages(){
        global $mysqli;
        $query = "SELECT * FROM menu WHERE category='Beverage'";
        $result = $mysqli->query($query);
        $html = '';
        while ($row = $result->fetch_assoc()){

        }
    }
    //TODO:Build the cart with cookies
    public function addToCart(){

    }
    //TODO: display the cart
    public function showCart(){

    }
    //TODO: place in orders table and use trigger to update into table
    public function placeOrder(){

    }
    //TODO: allow for customer to view currently placed order
    public function viewOrder(){

    }
    //TODO: using cookies generate a bill and allow for payment online
    //TODO: use an SQL procedure somewhere
    public function generateBill(){

    }
}