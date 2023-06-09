<!doctype html>
<html lang="en">

<head>
    <?php include "includes/shared_head.php"; ?>
    <title>Trivia Game | Login</title>

    <link rel="stylesheet" type="text/css" href="/css/login-register.css">
</head>

<body>

<?php include "includes/background.php" ?>

<main>
    <h1>Register</h1>
    <h2>Already have an account? <a href="login.php">Login</a></h2>
    <?php include "includes/mergedloginError.php" ?>
    <form action="forms/mergedlogin.php" method="post" autocomplete="on">
        <label for="usernameInput">Username</label><input type="text" name="username" id="usernameInput" required maxlength="32" minlength="4">
        <label for="emailInput">Email</label><input type="email" name="email" id="emailInput" required maxlength="512">
        <label for="passwordInput">Password</label><input type="password" name="password" id="passwordInput" required>
        <label for="password_confirmInput">Confirm password</label><input type="password" name="password_confirm" id="password_confirmInput" required>
        <input type="hidden" name="type" value="register">
        <input type="submit" class="anim-btn" value="Register">
    </form>
</main>

<?php include "includes/nav.php"; ?>
</body>
</html>