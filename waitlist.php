<?php
/**
 * Created by PhpStorm.
 * User: karti
 * Date: 30-Oct-17
 * Time: 9:21 PM
 */
include "dbconfig.php";
if (isset($_POST['name'])){
    addCustomerToList($_POST['name']);
    exit();
}
if (isset($_POST['dis'])){
    showWaitList();
    exit();
}
if (isset($_POST['remId'])){
    removeCustomerFromList($_POST['remId']);
    exit();
}

function addCustomerToList($name){
    global $mysqli;
    if (!($mysqli->query("INSERT INTO waitlist(Name) VALUES ('$name')"))){
        echo $mysqli->error;
    }
}
function showWaitList(){
    global $mysqli;
    if ($res = $mysqli->query("SELECT * FROM waitlist")){
        if ($res->num_rows == 0) {
            echo "no customers in waitlist";
            return;
        }
        else {
            while ($row = $res->fetch_assoc()){
                echo <<<EOT
                <div class = "col-xs-12 card">
                <table class="table">
                <tbody>
                <tr>
                <th><h1 class="nav-heading">{$row['Name']}</h1></th>
                <th><button class="btn btn-done remove" value="{$row['cust_id']}"><i class="material-icons">remove</i> </button> </th>
</tr>
</tbody>
</table>
</div>
EOT;
            }
        }
    }
}
function removeCustomerFromList($id){
    global $mysqli;
    if ($mysqli->query("DELETE FROM waitlist WHERE cust_id = $id")){
        echo "customer reserved";
    }
    else
        echo $mysqli->error;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage entries in your menu</title>
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
    <link rel="stylesheet" href="css/edits.css">
    <script>
        function add() {
            var name = $('#custName').val();
            console.log(name);
            $.ajax({
                method: 'POST',
                url: 'waitlist.php',
                data: {'name':name}
            }).done(function (data) {
                console.log("done");
                show();
            });
        }
        function remove(id) {
            console.log(id);
            $.ajax({
                method: 'POST',
                url: 'waitlist.php',
                data: {'remId':id}
            }).done(function (data) {
                console.log("done");
                show();
            });
        }
        function show() {
            console.log("getting data...");
            $.ajax({
                method: 'POST',
                url: 'waitlist.php',
                data: {'dis':1}
            }).done(function (data) {
                $('.target').html(data);
                console.log("done");
            });
        }
        $(document).ready(function () {
            show();
            $('#add').click(add);
            $('.target').on('click', '.remove', function () {
                var id = $(this).val();
                remove(id);
            });
        });
    </script>
    <style>
        legend {
            padding:10px;
        }
    </style>
</head>
<body>
<div id="main">
    <nav class="navbar alliedNav">
        <div class="container-fluid">
            <div class="row">
                <h1 class="col-md-12 col-sm-12 nav-heading">WaitList</h1>
            </div>
        </div>
    </nav>
    <!--------------------------------END OF NAVBAR ---------------------------------------->
</div>
<br>
<br>
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="name..." name="cust-name" id="custName" required />
        </div>
        <div class="col-xs-4">
            <button class="btn btn-done" id="add">Add</button>
        </div>
    </div>
    <br>
    <div class="row">
        <legend>Customers</legend>
        <div class="target"></div>
    </div>
</div>

</body>
</html>
