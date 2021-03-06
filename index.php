
<?php
    include 'dbconfig.php';
    session_start();
    $sql = "SELECT table_no FROM tables WHERE name IS NULL";
    $result = $mysqli->query($sql);
    $dropdown_content = "";
    if ($result->num_rows == 0) {
        $dropdown_content = "<option>No table available</option>";
    }
    else {
        while ($rows = $result->fetch_assoc()) {
            $dropdown_content .= "<option value='{$rows['table_no']}'>" . $rows['table_no'] . "</option>";
        }
    }
    if (isset($_POST['table']) || isset($_POST['customer_name']))
    {
        $no =(int) $_POST['table'];
        $_SESSION['tableno'] = $no;
        $_SESSION['cust_name'] = $_POST['customer_name'];
        $sql = "UPDATE tables SET name='{$_POST['customer_name']}' WHERE table_no = $no AND table_code='{$_POST['table_code']}'";
        if ($mysqli->query($sql))
            header("location:/dbms/home.php");
        else
            echo $mysqli->error;
        session_commit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Burgers and Dosas</title>
    <meta charset="utf-8">
    <meta lang="en">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="./js/lib/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Chela+One|Fira+Sans|Lato|Roboto|Ubuntu|Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<<<<<<< HEAD
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="./css/lib/bootstrap.min.css">
=======
        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-101884646-5"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-101884646-5');
</script>

>>>>>>> b4d0b2e83d50978161159aeeb549df9b904c51af
    <!-- Optional theme -->
    <link rel="stylesheet" href="./css/lib/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="./js/lib/bootstrap.min.js"></script>
    <!-- JQuery script -->
    <style>
        body {
            background: #1D120C;
        }
        .mainHeading {
            font-family: 'Pacifico',cursive;
            text-align: center;
            color: white;
            text-shadow: -1px 0 red, 0 1px red, 1px 0 black, 0 -1px black;
        }
        .main {
            position: absolute;
            z-index: -1;
            top: 0px;
        }
        select {
            background: red!important;
            color: white!important;
            border:2px solid #f44336!important;
        }
        .book {
            margin:20px;
        }
        .col-md-5 {
            margin-left: -60px;
            text-align: center;
        }
        @media only screen and (max-width: 600px){
            .col-md-5 {
                margin-left: 0px;
            }
        }
    </style>
    <script>
    $(document).ready(function() {
        $('.names').click(function () {
            $(this).css('border', '2px solid #f44336');
        });
        $('li').click(function () {
            var table = $(this).val();
            $('.dropdown .btn').html(table + " " + "<span class='caret'></span>");
        });
    });
    </script>
</head>
<body>
    <h1 class="mainHeading">Burgers <br>and <br>Dosas</h1>
    <img class="img-responsive main" src="images/main3_edit.jpg"/>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-5 col-sm-12 col-xd-12">
                    <form action="index.php" method="post" class="form-horizontal">
                        <select class="form-control selection" id="table" name="table">
                            <?php
                            echo $dropdown_content;
                            ?>
                        </select>
                        <br>
                        <input type="text" id="input" name="customer_name" class="form-control names" placeholder="Your name" required="required">
                        <br>
                        <input type="text" id="code" name="table_code" class="form-control names" placeholder="table code" required="required">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-danger book">Book</button>
                            <a href="home.php"><button type="button" class="btn btn-danger book">View Menu</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>
</html>
