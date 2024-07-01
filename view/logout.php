<?php
session_start();
unset($_SESSION['auth']);
unset($_SESSION['auth_user']);
$_SESSION['status'] = "You are logged out";
header("Location: ../login.php");
