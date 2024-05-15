<?php
session_start();
// syntax untuk mengarahkan admin untuk login terlebih dahulu
if ($_SESSION['login'] == false) {
    header('location: ../AdminPanel/login.php');
}
