<?php

require_once '../includes/database.php';
require_once '../includes/user.php';

$db = Database::getConn();

var_dump(User::userExistsById(1));


