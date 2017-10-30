<?php
/**
 * Created by PhpStorm.
 * User: datron
 * Date: 19-Oct-17
 * Time: 8:12 AM
 */
$host = "localhost";
$username = "root";
$pass = "";
$db_name = "digimenu";

$mysqli = new mysqli($host,$username,$pass,$db_name);
if ($mysqli->connect_error){
    echo "error".$mysqli->connect_error;
}
function lockTableRead($table,$sql){
    $q = "LOCK TABLES '$table' READ";
    $res = $sql->query($q);
}
function lockTableWrite($table,$sql){
    $q = "LOCK TABLES '$table' WRITE";
    $res = $sql->query($q);
}
function unlockTable($sqldb){
    $q = "UNLOCK TABLES";
    $res = $sqldb->query($q);
}

?>