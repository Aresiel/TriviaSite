<!doctype html>
<html lang="en">

<head>
    <?php include "includes/shared_head.php"; ?>
    <title>Trivia Game | Play</title>

    <link rel="stylesheet" type="text/css" href="/css/categories.css">
</head>

<body>

<?php include "includes/background.php"?>

<main>
    <div class="category-picker">
        <h1>
            Select a category
        </h1>
        <ul>
            <?php
            $categories_list = file_get_contents("https://opentdb.com/api_category.php");
            $categories_json = json_decode($categories_list, true);
            foreach ($categories_json['trivia_categories'] as $category){
                echo "<li><a href=\"/game.php?cat=" . $category['id'] . "&cat_name=" . urlencode($category['name']) . "\" class=\"anim-btn\">" . $category['name'] . "</a></li>";
            }
            ?>
        </ul>
    </div>
</main>

<?php include "includes/nav.php"; ?>
</body>
</html>