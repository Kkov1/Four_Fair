<?php
session_start();
if (!isset($_SESSION['auth'])) {
    $_SESSION['status'] = "Please Login to Continue";
    header("Location: ../login.php");
    exit(0);
}
