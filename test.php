<?php
include "dbconfig.php";
global $mysqli;
if ($res = $mysqli->query("CALL allocateWaiter()")){
    $row = $res->fetch_all();
    print_r($row[3][0]);
    $n = $res->num_rows;
    if ($n != 0) {
    $i = rand(0,3);
    echo $i;
//    return $row[$i];
    }
//    else
//    return 3;
    }
else
$mysqli->error;
?>