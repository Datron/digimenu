<?php
/**
 * Created by PhpStorm.
 * User: kartik
 * Date: 31-Oct-17
 * Time: 9:09 PM
 */
include 'dbconfig.php';
include 'menu.php';
//cart variable defined below
session_start();
$menu = new menu($mysqli);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage entries in your menu</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="./js/lib/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Chela+One|Fira+Sans|Lato|Roboto|Ubuntu|Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="./css/lib/bootstrap.min.css">
            <!-- Optional theme -->
    <link rel="stylesheet" href="./css/lib/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="./js/lib/bootstrap.min.js"></script>
    <!-- GreenSock JS -->
    <script src="./js/lib/TweenMax.min.js"></script>
    <script src="js/home.js"></script>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
<!------------------------------ START OF PAGE ----------------------------------------->
<div id="main">
    <nav class="navbar alliedNav">
        <div class="container-fluid">
            <div class="row input-group" id="search-div">
            <input type="text" placeholder="search" name="search" id="search" class="form-control">
                <span class="input-group-addon"><i class="material-icons">search</i></span>
            </div>
            <div class="row">
                <div class="table-responsive table-nav">
                    <table class="table table-condensed">
                        <thead>
                        <tr class="danger1">
                            <th><button class="btn btn-menu">All</button></th>
                            <th><button class="btn btn-menu">Burgers</button></th>
                            <th><button class="btn btn-menu">Dosas</button></th>
                            <th><button class="btn btn-menu">Beverages</button></th>
                            <th><button class="btn btn-menu ">Sides</button></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </nav>
    <!--------------------------------END OF NAVBAR ---------------------------------------->
</div>
<div class="container-fluid tabs" id="searchLoc">
    <div class="row cardView" id="searchTarget">
    </div>
</div>
<div class="container-fluid tabs" id="all">
    <div class="row cardView">
        <?php
        $menu->loadAll();
        ?>
    </div>
</div>
<div class="container-fluid tabs" id="Burgers">
    <div class="row cardView">
        <?php
        $menu->loadBurgers();
        ?>
    </div>
</div>
<div class="container-fluid tabs" id="Dosas">
    <div class="row cardView">
        <?php
        $menu->loadDosa();
        ?>
    </div>
</div>
<div class="container-fluid tabs" id="Sides">
    <div class="row cardView">
        <?php
        $menu->loadSides();
        ?>
    </div>
</div>
<div class="container-fluid tabs" id="Beverages">
    <div class="row cardView">
        <?php
        $menu->loadBeverages();
        ?>
    </div>
</div>
<div class="container-fluid postButton">
    <button type="button" class="btn btn-post-material" data-toggle="modal" data-target="#cartModal" data-backdrop="static"><i class="material-icons">shopping_cart</i></button>
</div>
<div class="modal fade" role="dialog" id="cartModal">
    <div class="modal-body" style="background: white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <br>
        <div class="alert alert-info">
        <?php
        if(isset($_SESSION['tableno'])) {
            echo "<h4>Table: " . $_SESSION['tableno'] . "</h4>";
            echo "<h4>Name: " . $_SESSION['cust_name'] . "</h4>";
        }
        else
            echo "You have booked your table yet";
        ?>
        </div>
        <div class="alert alert-success">
            <strong>Success!</strong> Order placed successfully.
        </div>
        <div class="alert alert-danger">
            <strong>Failed.</strong><message></message>Order has failed. Please try again.
        </div>
        <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#curCart">Cart</a></li>
            <li><a data-toggle="tab" href="#prevOrders" id="prevOrd">Previous Orders</a></li>
        </ul>
        <div class="tab-content">
            <div id="curCart" class="tab-pane fade">

            </div>
            <div id="prevOrders" class="tab-pane fade">

            </div>
        </div>
    </div>

</div>
</body>
</html>
