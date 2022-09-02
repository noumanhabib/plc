<?php
session_start();

if (!isset($_SESSION['shop_id'])) {
    header("location: " . ROOT . "/login.php");
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("location: " . ROOT . "/login.php");
}
$shop_id = $_SESSION["shop_id"];