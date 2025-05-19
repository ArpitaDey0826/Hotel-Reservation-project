<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['email']) && isset($_POST['password'])) {

        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if ($email === "" || $password === "") {
            echo "null email/password!";
        } else if ($email === $password) {  

            setcookie('status', 'true', time()+300, '/');
            header('Location: ../view/index.php');
            exit();
        } else {
            echo "invalid user!";
        }

    } else {
        echo "Missing email or password!";
    }

} else {
    echo "Invalid request! Please submit the form!";
}
?>
