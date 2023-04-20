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
    <div class="question-answers"><?php
        if ($user->total_answers == 0) {
            echo "<span>N</span><span>/</span><span>A</span>";
        } else {
            echo "<span>" . $user->correct_answers . "</span><span>/</span><span>" . $user->total_answers . "</span>";
        }
        ?> </div>
    <div class="question-percent">≈ <?php
        if ($user->total_answers == 0){
            echo "0% correct";
        } else {
            echo round(100*$user->correct_answers/$user->total_answers) . "% correct";
        }
        ?></div>
    <h2 class="username"><?php echo $user->username ?></h2>
    <h2 class="email">Email: <span><?php echo $user->email ?></span></h2>

    <a href="/leaderboard.php" class="btn">View leaderboard</a>
    <a href="/forms/logout.php" class="red-btn">Logout</a>

</main>

<?php include "includes/nav.php"; ?>
</body>
</html>