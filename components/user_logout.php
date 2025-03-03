<?php

include 'connect.php';

session_start();
session_unset();
session_destroy();

header('location:../home.php');
$message[] = 'New job vacancy added!';

?>