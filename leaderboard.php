<!doctype html>
<html lang="en">

<head>
    <?php include "includes/shared_head.php"; ?>
    <title>Trivia Game | Leaderboard</title>

    <link type="text/css" rel="stylesheet" href="/css/leaderboard.css">
</head>

<body>

<?php include "includes/background.php"?>

<?php
require_once "includes/database.php";

$conn = Database::getConn();
$leaderboardStatement = $conn->prepare("SELECT username, total_answers, correct_answers FROM users ORDER BY correct_answers DESC LIMIT 10");
$leaderboardStatement->execute();
$result = $leaderboardStatement->get_result();
$result->fetch_all(MYSQLI_ASSOC);
$leaderboardStatement->close();
?>

<main>
    <table class="leaderboard">
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>Correct answers</th>
            <th>Total answers</th>
            <th>Percent correct</th>
        </tr>
        <?php
        $count = 1;
        foreach ($result as $row){
            if($row['correct_answers'] == 0) continue;
            echo "<tr><td>" . $count . ".</td><td>" . $row['username'] . "</td><td>" . $row['correct_answers'] . "</td><td>" . $row['total_answers'] . "</td><td>" . round(100*$row['correct_answers']/$row['total_answers']) . "%</td></tr>";
            $count++;
        }
        ?>
    </table>
    <a class="btn" href="/account.php">Back</a>
</main>

<?php include "includes/nav.php"; ?>
</body>
</html>