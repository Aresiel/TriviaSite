<!doctype html>
<html lang="en">

<head>
    <?php include "includes/shared_head.php"; ?>
    <title>Trivia Game | <?php echo $_GET['cat_name'] ?></title>

    <link rel="stylesheet" type="text/css" href="/css/game.css">
</head>

<body>

<?php include "includes/background.php"?>

<main>
    <?php
    if (!isset($_SESSION['triviaToken'])) {
        $token_data = file_get_contents("https://opentdb.com/api_token.php?command=request");
        $token_json = json_decode($token_data, true);
        $_SESSION['triviaToken'] = $token_json['token'];
    }

    if (!ctype_digit($_GET['cat'])) { // Check if given category is an integer, https://stackoverflow.com/a/15448444
        header("Location: /home.php"); // Should never happen unless someone messes with it manually.
        exit();
    }

    $_SESSION['currentCategory'] = $_GET['cat'];

    $question_data = file_get_contents("https://opentdb.com/api.php?amount=1&category=" . $_GET['cat'] . "&token=" . $_SESSION['triviaToken']);
    $question = json_decode($question_data, true)['results'][0];

    $_SESSION['correctAnswer'] = $question['correct_answer'];

    $answers = [];

    $answers[] = $question['correct_answer'];
    foreach ($question['incorrect_answers'] as $answer){
        $answers[] = $answer;
    }

    shuffle($answers);

    ?>
    <div class="question-text"><?php echo $question['question'] ?></div>
    <div class="question-answers">
        <?php
            foreach ($answers as $answer){
                echo "<a href=\"/forms/checkAnswer.php?answer=" . urlencode($answer) . "\" class=\"anim-btn\">" . $answer . "</a>";
            }
        ?>
    </div>
    <div class="other-buttons">
        <a href="/categories.php" class="btn">Back</a>
        <a href="" class="red-btn">Skip</a>
    </div>
    <div class="previous-answer-wrapper">
        <?php
        if(isset($_GET['correct'])){
            $correct = $_GET['correct'] == "true";
            if($correct){
                echo "<div class=\"previous-answer-notification green\">Correct answer!</div>";
            } else {
                echo "<div class=\"previous-answer-notification red\">Incorrect answer.</div>";
            }

        }
        ?>
    </div>

</main>

<?php include "includes/nav.php"; ?>
</body>
</html>