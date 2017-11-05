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
            <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
            <link href="https://fonts.googleapis.com/css?family=Chela+One|Fira+Sans|Lato|Roboto|Ubuntu|Pacifico" rel="stylesheet">
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

            <!-- Optional theme -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

            <!-- Latest compiled and minified JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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