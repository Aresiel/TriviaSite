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
    <h1>Login</h1>
    <h2>Don't have an account? <a href="register.php">Register</a></h2>
    <?php include "includes/mergedloginError.php" ?>
    <form action="forms/mergedlogin.php" method="post" autocomplete="on">
        <label for="emailInput">Email</label><input type="email" name="email" id="emailInput" required maxlength="512">
        <label for="passwordInput">Password</label><input type="password" name="password" id="passwordInput" required>
        <input type="hidden" name="type" value="login">
        <input type="submit" class="anim-btn" value="Login">
    </form>
</main>

<?php include "includes/nav.php"; ?>
</body>
</html>