<?php

require_once '../includes/database.php';
require_once '../includes/user.php';

$db = Database::getConn();

if($_POST['type'] == "login") {
    echo "login";
} elseif($_POST['type'] == "register") {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if(!User::validUsername($username)){
        header('Location: /register.php?error=invalidUsername');
        exit();
    } elseif(!User::validEmail($email)) {
        header('Location: /register.php?error=invalidEmail');
        exit();
    } elseif ($password != $password_confirm) {
        header('Location: /register.php?error=passwordMismatch');
        exit();
    } elseif(!User::validPassword($password)) {
        header('Location: /register.php?error=invalidPassword');
        exit();
    }

    $newUser = User::registerUser($username, $email, $password);
} else {
    echo "Invalid type";
}


