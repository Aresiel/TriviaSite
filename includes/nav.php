<?php
    $selectionMap = array(
            "/home.php" => "home",
            "/play.php" => "game"
    );
    $currentFile = $selectionMap[$_SERVER['PHP_SELF']];
?>

<nav class="navbar">
    <a <?php if ($currentFile != "home") echo "href=\"/home.php\""; ?> class="<?php if ($currentFile == "home") echo "selected"; ?>"><i class="fa fa-home" aria-hidden="true"></i></a>
    <a <?php if ($currentFile != "game") echo "href=\"/play.php\""; ?> class="<?php if ($currentFile == "game") echo "selected"; ?>"><i class="fa fa-play" aria-hidden="true"></i></a>
    <a class="<?php if ($currentFile == "user") echo "selected"; ?>"><i class="fa fa-user" aria-hidden="true"></i></a>
</nav>