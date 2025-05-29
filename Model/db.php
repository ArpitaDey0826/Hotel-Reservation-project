<?php
function getConnection() {
    $host = "127.0.0.1";
    $user = "root";
    $pass = "";
    $db   = "hotel2";

    $con = mysqli_connect($host, $user, $pass, $db);

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $con;
}
?>
