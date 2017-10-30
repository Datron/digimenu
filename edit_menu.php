<?php
    include 'dbconfig.php';
if (isset($_POST['dishName'])){
    $name = $_POST['dishName'];
    $des = $_POST['dishDes'];
    $cat = $_POST['category'];
    $target_dir = "images/";
    $target_file1 = $target_dir . basename($_FILES["foodimg"]["name"]);
    $sql = "INSERT INTO menu(name,description,category,img_src) VALUES('$name','$des','$cat','$target_file1')";
    if (!$mysqli->query($sql))
        echo $mysqli->error;
    move_uploaded_file($_FILES["foodimg"]["tmp_name"], $target_file1);
}
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
    <link rel="stylesheet" href="css/edits.css">
    <script src="js/edits.js"></script>
</head>
<body>
    <!------------------------------ START OF PAGE ----------------------------------------->
    <div id="main">
        <nav class="navbar alliedNav">
            <div class="container-fluid">
                <div class="row">
                    <a href="#"class="col-md-2 col-sm-1" id="nav-menu-button"><i class="material-icons mat-menu">menu</i></a>
                    <h1 class="col-md-8 col-sm-10 nav-heading">Burgers and Dosa</h1>
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
            <div class="col-md-3">
                <!--<ul>
                    <li><button id="insert" class="btn item"><h3 class="menu-options">Insert</h3></button></li>
                    <li><button id="update" class="btn item"><h3 class="menu-options">Update</h3></button></li>
                    <li><button id="modify" class="btn item"><h3 class="menu-options">Modify</h3></button></li>
                </ul>-->
                <h1 class="nav-heading">Orders</h1>
                <a href="#" class=""><h3 class="navOption">Current Orders</h3></a href="">
                <a href="#" class=""><h3 class="navOption">Completed</h3></a>
                <h1 class="nav-heading">Menu</h1>
                <a href="#" class=""><h3 class="navOption">Insert</h3></a>
                <a href="#" class=""><h3 class="navOption">Modify</h3></a>
                <a href="#" class=""><h3 class="navOption">Delete</h3></a>

            </div>
            <!--Main body where orders or modifiers are displayed-->
            <div class="col-md-8">
                <div class="inserting">
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

            </div>
        </div>
    </div>
</body>
</html>