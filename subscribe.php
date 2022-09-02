<?php
session_start();
require_once "./includes/global.php";
require_once "./includes/connect.php";
if (isset($_POST["subscribe"])) {
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    if (!$email || empty($email)) {
        header("Location: " . ROOT);
        $_SESSION["error"] = "Email field is required";
        exit();
    }

    $sql = "INSERT INTO subscribers (email) values ('{$email}');";
    if ($conn->query($sql)) {
        $_SESSION["success"] = "Subscribed successfully";
    } else {
        $_SESSION["error"] = "Error";
    }
    header("Location: " . ROOT);
    exit();
} else {
    $_SESSION["error"] = "Bad request";
    header("Location: " . ROOT);
    exit();
}