<?php

require_once '../includes/database.php';
require_once '../includes/user.php';

$db = Database::getConn();

if($_POST['type'] == "login") {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if(!User::validEmail($email)) {
        header('Location: /login.php?error=invalidEmail');
        exit();
    } elseif(!User::validPassword($password)) {
        header('Location: /login.php?error=invalidPassword');
        exit();
    }

    $user = User::loginUser($email, $password);

    if(!$user){
        header('Location: /login.php?error=invalidCredentials');
        exit();
    }

    $_SESSION['user'] = $user->serializeUser();
    header('Location: /account.php');
    exit();


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

    $_SESSION['user'] = User::registerUser($username, $email, $password)->serializeUser();
    header("Location: /account.php");
} else {
    echo "Invalid type";
}


