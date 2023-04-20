<!doctype html>
<html lang="en">
<head>
    <?php include "includes/shared_head.php"; ?>
    <title>Trivia Game | Account</title>

        <link rel="stylesheet" type="text/css" href="/css/account.css">
</head>
<body>
<?php include "includes/background.php" ?>

<?php
    require_once("includes/user.php");
    $user = User::unserializeUser($_SESSION['user']);
?>

<main>
    <h1>Your account</h1>
    <h2>Username: <input value="<?php echo $user->username ?>"></input></h2>
    <h2 class="email">Email: <?php echo $user->email ?></h2>
    <p>Questions correct: <?php
            if ($user->total_answers == 0) {
                echo "N/A";
            } else {
                echo $user->correct_answers . "/" . $user->total_answers;
            }
        ?> </p>
</main>

<?php include "includes/nav.php"; ?>
</body>
</html>