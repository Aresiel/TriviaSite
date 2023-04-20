<?php
    if (session_status() == PHP_SESSION_NONE) {
        //session_start();
    } elseif (session_status() == PHP_SESSION_DISABLED) {
        die("Session support is disabled. This functionality is required for this website to work.");
    }
?>

<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<!-- External CSS -->
<link type="text/css" rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
<link type="text/css" rel="stylesheet" href="/css/font-awesome-4.7.0/css/font-awesome.min.css">

<!-- Own CSS -->
<link type="text/css" rel="stylesheet" href="/css/common.css">
