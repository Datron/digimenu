<?php
    include 'dbconfig.php';
    session_start();
if (isset($_POST['dishName'])){
    $name = $_POST['dishName'];
    $des = $_POST['dishDes'];
    $cat = $_POST['category'];
    $cost = $_POST['dishCost'];
    $target_dir = "images/";
    $target_file1 = $target_dir . basename($_FILES["foodimg"]["name"]);
    $sql = "INSERT INTO menu(name,description,category,img_src,cost) VALUES('$name','$des','$cat','$target_file1',$cost)";
    if (!$mysqli->query($sql))
        echo $mysqli->error;
    move_uploaded_file($_FILES["foodimg"]["tmp_name"], $target_file1);
}
if(isset($_POST['load'])) {
    printOrders();
    exit();
}
if (isset($_POST['ordcomp'])){
    orderComplete($_POST['ordcomp']);
    exit();
}
if (isset($_POST['comp_ord'])){
    for($i=1;$i<=12;$i++) {
        echo "<div class='row carView'>";
        getCompletedOrders($i);
        echo "</div>";
    }
    exit();
}
if (isset($_POST['staffName'])){
    $sql = "INSERT INTO staff(staff_name, role, phone) VALUES('{$_POST['staffName']}','{$_POST['staffRole']}','{$_POST['staffPhone']}')";
    if (!($mysqli->query($sql)))
        echo $mysqli->error;
}
function orderComplete($ord_id){
    global $mysqli;
    $sql = "UPDATE orders SET status=2 WHERE order_no=$ord_id";
    if ($mysqli->query($sql))
        echo "Order with order id ".$ord_id." is done";
    else
        echo $mysqli->error;
}
function printOrders(){
    for($i=1;$i<=12;$i++) {
        if ($i % 2 == 0)
            echo "<div class='row cardView'>";
        getCurrentOrders($i);
        echo "</div>";
    }
}
function getCurrentOrders($i){
    global $mysqli;
    $html = "";
    $ord_id = 0;
    $sql = "SELECT * FROM orders WHERE table_no={$i} AND status=1";
    $result = $mysqli->query($sql);
//    var_dump($result->fetch_all());
    if ($result->num_rows != 0) {
        $html .= <<<EOT
                <div class="col-md-1"></div>
                <div class="col-md-5 card">
<div class="row table-no">
                <h1 class="table-no-print">{$i}</h1>
                </div>
EOT;
        $html .= <<<EOT
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                            <th>status</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
EOT;
        while ($row = $result->fetch_assoc()) {
            $q = "SELECT Name FROM menu WHERE item_id={$row['item_id']}";
            $r = $mysqli->query($q);
            $name = $r->fetch_array()[0];
            $ord_id = $row['order_no'];
            $html .= <<<EOT
            <tr>
            <th><div class="checkbox">
<label><input type="checkbox" value="{$row['order_no']}"></label>
</div></th>
            <th>{$name}</th>
            <th>{$row['quantity']}</th>
            </tr>                        
EOT;
        }
        $html .= <<<EOT
                    </tbody>
                    </table>
                </div>
                <button class="btn btn-done" value="$ord_id" id="ord-complete">Order Completed</button>
            </div>
EOT;
    }
    else {
        return;
    }
    $html .= "</div>";
    echo $html;
}
function getCompletedOrders($i){
    global $mysqli;
    $html = "";
    $mes ="";
    $sql = "SELECT * FROM orders WHERE table_no=$i";
    $result = $mysqli->query($sql);
    if ($result->num_rows != 0) {
        $html .= <<<EOT
        <div class="col-md-1"></div>
                <div class="col-md-7 card">
<div class="row table-no">
                <h1 class="table-no-print">{$i}</h1>
                </div>
EOT;
        $html .= <<<EOT
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
EOT;
        while ($row = $result->fetch_assoc()) {
            $q = "SELECT Name FROM menu WHERE item_id={$row['item_id']}";
            $r = $mysqli->query($q);
            $name = $r->fetch_array()[0];
            $html .= <<<EOT
                    <tr>
                    <th>{$name}</th>
                    <th>{$row['quantity']}</th>
                    </tr>                        
EOT;
            $status = $row['status'];
        }
        if ($status == 2)
            $mes = "Order done but bill not paid";
        elseif ($status == 3)
            $mes = "Order done and bill paid";
        elseif ($status == 4)
            $mes = "Order not prepared";
        $html .= <<<EOT
                    </tbody>
                    </table>
                </div>
                <div class="alert alert-info">status: {$mes}</div>
            </div>
</div>
EOT;
    }
    $html .= "</div>";
    echo $html;
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
    <!-- JQuery script -->
    <!-- GreenSock JS -->
    <script src="./js/lib/TweenMax.min.js"></script>
    <link rel="stylesheet" href="./css/edits.css">
    <script src="./js/edits.js"></script>
</head>
<body>
<!------------------------------ NAVIGATION MENU -------------------------------------->
<div id="nav-menu" class="navMenu">
<!--    <h1 class="nav-heading">Burgers and Dosas</h1>-->
    <a href="#" class="nav-close" id="navClose"><i class="material-icons">close</i></a>
    <h1 class="nav-heading">Orders</h1>
    <a href="#orders" class=""><h3 class="navOption">Current Orders</h3></a>
    <a href="#completed" class=""><h3 class="navOption">Completed</h3></a>
    <h1 class="nav-heading">Menu</h1>
    <a href="#menu_insert" class=""><h3 class="navOption">Insert</h3></a>
    <a href="#menu_modify" class=""><h3 class="navOption">Modify</h3></a>
    <h1 class="nav-heading">Staff</h1>
    <a href="#staff_insert" class=""><h3 class="navOption">Insert</h3></a>
    <a href="#staff_modify" class=""><h3 class="navOption">Modify</h3></a>

</div>
<!------------------------------ START OF PAGE ----------------------------------------->
<div id="main">
    <nav class="navbar alliedNav">
        <div class="container-fluid">
            <div class="row">
                <a href="#"class="col-md-2 col-sm-1" id="nav-menu-button"><i class="material-icons mat-menu">menu</i></a>
                <h1 class="col-md-8 col-sm-10 nav-heading">Admin Page</h1>
            </div>
        </div>
    </nav>
    <!--------------------------------END OF NAVBAR ---------------------------------------->
</div>
    <br>
    <br>
    <div class="container-fluid view">
        <!--main row-->
        <div class="row">
            <!--menu column defined here-->
            <div class="col-md-3"></div>
            <!--Main body where orders or modifiers are displayed-->
            <div class="col-md-8">
                <!--ORDERS-->
                <div class="dbHandler orders">

                </div>
                <div class="dbHandler complete-order">

                </div>
                <!-- insert -->
                <div class="dbHandler inserting">
                    <form class="form-horizontal" method="post" enctype=multipart/form-data>
                        <legend>Insert</legend>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control col-md-5" id="name" placeholder="name" name="dishName">
                            <br>
                            <label for="description">Description</label>
                            <textarea class="form-control col-md-5" rows="5" id="description" placeholder="description of your dish" name="dishDes"></textarea>
                            <br>
                            <label for="category">Category</label>
                            <input class="form-control col-md-5" id="category" placeholder="category" name="category">
                            <br><label for="category">Cost</label>
                            <input class="form-control col-md-5" id="cost" placeholder="price" name="dishCost">
                        </div>
                        <br>
                        <div class="form-group">
                            <img src="" class="food-pic img-responsive" id="foodim">
                            <br><br>
                            <input type="file" class="filesup" style="display:none" name="foodimg">
                            <button type="button" class="btn btn-success" id="upload">Upload New Image</button>
                        </div>
                        <button type="submit" class="btn btn-primary submit">Submit</button>
                    </form>
                </div>
                <!-- modify and delete -->
                <div class="dbHandler modifying" style="display: none">
                    <legend>Modify</legend>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $getItems = "SELECT * FROM menu";
                        $result1 = $mysqli->query($getItems);
                        $tbody = "";
                        while ($row = $result1->fetch_assoc()){
                            $tbody .= "<tr value='{$row['item_id']}'>";
                            $tbody .= "<td>".$row['Name']."</td>";
                            $tbody .= "<td>".$row['description']."</td>";
                            $tbody .= "<td>".$row['category']."</td>";
                            $tbody .= "<td><input type=\"file\" class=\"filesup1\" style=\"display:none\" name=\"foodimg\">
                            <button type=\"button\" class=\"btn btn-success\" id=\"upload1\">Upload New Image</button></td>";
                            $tbody .= "<td><button type=\"button\" class=\"btn btn-danger\" id=\"dele\"><i class=\"material-icons\">delete</i></button></td>";
                            $tbody .= "</tr>";
                        }
                        echo $tbody;
                        //TODO: add excel like ability to modify cells for menu items
                        ?>
                        </tbody>
                    </table>
                </div>

                <!--END of modifying segment-->
                <!--Staff Insert-->
                <div class="dbHandler staffInsert" style="display: none">
                    <form class="form-horizontal" method="post" enctype=multipart/form-data>
                        <legend>Insert</legend>
                        <div class="form-group">
                            <label for="name">Staff Name</label>
                            <input class="form-control col-md-5" id="staff-name" placeholder="name" name="staffName" required>
                            <br>
                            <label for="description">Role</label>
                            <input class="form-control col-md-5" id="staff-role" placeholder="name" name="staffRole" required>
                            <br>
                            <label for="category">Phone</label>
                            <input class="form-control col-md-5" id="staff-phone" placeholder="phone number" name="staffPhone" type="tel" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary submit">Submit</button>
                    </form>
                </div>
                <!--End of staff insert-->
                <!--Staff Modify-->
                <div class="dbHandler staffModify" style="display: none">
                    <legend>Modify</legend>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $getItems = "SELECT * FROM staff";
                        $result1 = $mysqli->query($getItems);
                        $tbody = "";
                        while ($row = $result1->fetch_assoc()){
                            $tbody .= "<tr value='{$row['staff_id']}'>";
                            $tbody .= "<td>".$row['staff_name']."</td>";
                            $tbody .= "<td>".$row['role']."</td>";
                            $tbody .= "<td>".$row['phone']."</td>";
                            $tbody .= "<td><button type=\"button\" class=\"btn btn-danger\" id=\"del\"><i class=\"material-icons\">delete</i></button></td>";
                            $tbody .= "</tr>";
                        }
                        //TODO: add excel like ability to modify staff details
                        echo $tbody;
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>