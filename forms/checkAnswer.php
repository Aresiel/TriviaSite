<?php
require_once("../includes/user.php");

$correct_answer = $_SESSION['correctAnswer'];
$answer = urldecode($_GET['answer']);

$correct = ($correct_answer == $answer); // If $correct_answer and $answer are the same, $correct will be true

if(isset($_SESSION['user'])){
    $user = User::unserializeUser($_SESSION['user']);
    $user->updateQuestions($correct);
    $user->updateSession();
}

unset($_SESSION['answer']); // Stop people from resending this request to farm correct answers.
unset($_SESSION['correctAnswer']);

if($correct){
    header("Location: /game.php?cat=" . $_SESSION['currentCategory'] . "&correct=true");
} else {
    header("Location: /game.php?cat=" . $_SESSION['currentCategory'] . "&correct=false");
}