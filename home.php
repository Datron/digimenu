<?php
/**
 * Created by PhpStorm.
 * User: kartik
 * Date: 31-Oct-17
 * Time: 9:09 PM
 */
include 'dbconfig.php';
include 'menu.php';
$menu = new menu($mysqli);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage entries in your menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Chela+One|Fira+Sans|Lato|Roboto|Ubuntu" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- JQuery script -->

    <!-- GreenSock JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
    <script src="js/menu.js"></script>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
<!------------------------------ START OF PAGE ----------------------------------------->
<div id="main">
    <nav class="navbar alliedNav">
        <div class="container-fluid">
            <div class="table-responsive table-nav">
                <table class="table table-condensed">
                    <thead>
                        <tr class="danger1">
                            <th><button class="btn btn-menu active">All</button></th>
                            <th><button class="btn btn-menu">Burgers</button></th>
                            <th><button class="btn btn-menu">Dosas</button></th>
                            <th><button class="btn btn-menu">Beverages</button></th>
                            <th><button class="btn btn-menu ">Sides</button></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </nav>
    <!--------------------------------END OF NAVBAR ---------------------------------------->
</div>
<div class="container-fluid postButton">
    <button type="button" class="btn btn-post-material" data-toggle="modal" data-target="#postsModal" data-backdrop="static"><i class="material-icons">add</i></button>
</div>
</body>
</html>
