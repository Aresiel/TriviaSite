<?php
    $selectionMap = array(
            "/home.php" => "home",
            "/play.php" => "game"
    );
    $currentSection = $selectionMap[$_SERVER['PHP_SELF']];
?>

<nav class="navbar">
    <a <?php if ($currentSection != "home") echo "href=\"/home.php\""; ?> class="<?php if ($currentSection == "home") echo "selected"; ?>"><i class="fa fa-home" aria-hidden="true"></i></a>
    <a <?php if ($currentSection != "game") echo "href=\"/play.php\""; ?> class="<?php if ($currentSection == "game") echo "selected"; ?>"><i class="fa fa-play" aria-hidden="true"></i></a>
    <a class="<?php if ($currentSection == "user") echo "selected"; ?>"><i class="fa fa-user" aria-hidden="true"></i></a>
</nav>