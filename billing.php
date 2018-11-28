<?php
/**
 * Created by PhpStorm.
 * User: karti
 * Date: 30-Oct-17
 * Time: 9:21 PM
 */
session_start();
include "dbconfig.php";
$table = $_SESSION['tableno'];
if (isset($_POST['feed']))
{
    $feedback = $_POST['text'];
    $q1 = "INSERT INTO feedback VALUES($feedback)";
    $mysqli->query($q1);
}
$q = "UPDATE tables SET name=NULL,order_no=NULL,preferences=NULL,waiter_name=NULL WHERE table_no=$table";
$q1 = "DELETE FROM orders WHERE table_no=$table";
if ($mysqli->query($q)){
    if ($mysqli->query($q1)){
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
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="./css/lib/bootstrap.min.css">
                    <!-- Optional theme -->
            <link rel="stylesheet" href="./css/lib/bootstrap-theme.min.css">

            <!-- Latest compiled and minified JavaScript -->
            <script src="./js/lib/bootstrap.min.js"></script>
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
                textarea {
                    color: black;
                }
                select {
                    background: red!important;
                    color: white!important;
                    border:2px solid #f44336!important;
                }
                .thank {
                    font-family: 'Pacifico',cursive;
                    text-align: center;
                    color: white;
                    text-shadow: 2px 2px black;
                }
            </style>
            <script>
                $(document).ready(function() {
                    $('.names').click(function () {
                        $(this).css('border', '2px solid #f44336');
                    });
                    $('.btn .btn-done').click(function () {
                       var feedback = $('textarea').text();
                       $.ajax({
                          method: 'POST',
                          url: 'billing.php',
                          data: {'feed':1,'text':feedback}
                       }).done(function () {
                           $('textarea').remove();
                           console.log("Thank you for the feedback");
                       })
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
                <h1 class="thank"> Your payment has been processed. Thank you and please visit again. </h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-5" style="margin-left:50px">
                    <textarea class="form-control" rows="3" placeholder="Your feedback..">
                </textarea>
                    <br>
                <button type="button" class="btn btn-done">Submit</button>
                </div>
            </div>
        </div>
        </body>
        </html>
<?php
    }
    else
       echo $mysqli->error;
}
else
    echo $mysqli->error;
?>