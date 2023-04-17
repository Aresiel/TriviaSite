<?php

require_once '../includes/database.php';
require_once '../includes/user.php';

$db = Database::getConn();

if($_POST['type'] == "login") {
    echo "login";
} elseif($_POST['type'] == "register") {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password_confirm = trim($_POST['password_confirm']);

    if(!User::validUsername($username)){
        header('Location: /register.php?error=invalidUsername');
        exit();
    } elseif(!User::validEmail($email)) {
        header('Location: /register.php?error=invalidEmail');
        exit();
    } elseif(!User::validPassword($password)) {
        header('Location: /register.php?error=invalidPassword');
        exit();
    } elseif ($password != $password_confirm) {
        header('Location: /register.php?error=passwordMismatch');
        exit();
    } elseif(User::userExistsByEmail($email)) {
        header('Location: /register.php?error=accountExists');
        exit();
    }

    $newUser = User::registerUser($username, $email, $password);
    var_dump($newUser);
} else {
    echo "Invalid type";
}


