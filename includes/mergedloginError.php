<?php

if(isset($_GET["error"])) {
    $errorMessage = match ($_GET["error"]) {
        "invalidUsername" => "Invalid username. Username must be at least 4 characters long and contain only alphanumerical characters and _.",
        "invalidEmail" => "Invalid email. Email must contain @.",
        "invalidPassword" => "Invalid password. Password must be between 8 and 256 characters.",
        "passwordMismatch" => "Password and password confirmation do not match.",
        "accountExists" => "An account by this email already exists.",
        default => "Unknown error"
    };

    echo "<div class=\"error\">" . $errorMessage . "</div>";
}

