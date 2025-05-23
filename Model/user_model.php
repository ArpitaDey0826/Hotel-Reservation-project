<?php
require_once 'db.php';

function loginUser($email, $password) {
    $con = getConnection();

    $sql = "SELECT * FROM signup WHERE s_email = '$email' AND s_password = '$password'";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);

    mysqli_close($con);

    return $count === 1;
}

function registerUser($email, $password) {
    $con = getConnection();

    // Check if user already exists
    $checkSql = "SELECT * FROM signup WHERE s_email = '$email'";
    $checkResult = mysqli_query($con, $checkSql);
    if (mysqli_num_rows($checkResult) > 0) {
        mysqli_close($con);
        return "exists";
    }

    // Register new user
    $sql = "INSERT INTO signup (s_email, s_password) VALUES ('$email', '$password')";
    $success = mysqli_query($con, $sql);

    mysqli_close($con);
    return $success ? "success" : "fail";
}

?>
