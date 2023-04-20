<?php
    $selectionMap = array(
            "/home.php" => "home",
            "/categories.php" => "game",
            "/game.php" => "game",
            "/register.php" => "user",
            "/login.php" => "user",
            "/account.php" => "user"
    );
    $currentSection = $selectionMap[$_SERVER['PHP_SELF']];

    $homeSelected = $currentSection == "home";
    $playSelected = $currentSection == "game";
    $userSelected = $currentSection == "user";

    $login_url = "/register.php";
    if(isset($_SESSION['user'])){
        $login_url = "/account.php";
    }

?>

<nav class="navbar">
    <a <?php if (!$homeSelected) echo "href=\"/home.php\""; ?> class="<?php if ($homeSelected) echo "selected"; ?>"><i class="fa fa-home" aria-hidden="true"></i></a>
    <a <?php if (!$playSelected) echo "href=\"/categories.php\""; ?> class="<?php if ($playSelected) echo "selected"; ?>"><i class="fa fa-play" aria-hidden="true"></i></a>
    <a  <?php if (!$userSelected) echo "href=\"" . $login_url . "\""; ?> class="<?php if ($userSelected) echo "selected"; ?>"><i class="fa fa-user" aria-hidden="true"></i></a>
</nav>