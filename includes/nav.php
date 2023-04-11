<?php
    $selectionMap = array(
            "/home.php" => "home",
            "/play.php" => "game",
            "/game.php" => "game",
            "/login.php" => "user"
    );
    $currentSection = $selectionMap[$_SERVER['PHP_SELF']];

    $homeSelected = $currentSection == "home";
    $playSelected = $currentSection == "game";
    $userSelected = $currentSection == "user";

?>

<nav class="navbar">
    <a <?php if (!$homeSelected) echo "href=\"/home.php\""; ?> class="<?php if ($homeSelected) echo "selected"; ?>"><i class="fa fa-home" aria-hidden="true"></i></a>
    <a <?php if (!$playSelected) echo "href=\"/play.php\""; ?> class="<?php if ($playSelected) echo "selected"; ?>"><i class="fa fa-play" aria-hidden="true"></i></a>
    <a  <?php if (!$userSelected) echo "href=\"/login.php\""; ?> class="<?php if ($userSelected) echo "selected"; ?>"><i class="fa fa-user" aria-hidden="true"></i></a>
</nav>