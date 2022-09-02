<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <title>Admin Panel</title>

    <link rel="stylesheet" href="<?php echo ROOT ?>/admin/dist/css/app.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
    body {
        font-family: 'Inter', sans-serif;
    }
    </style>
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="<?php echo ROOT ?>/admin">
                    <span class="align-middle">PLC Admin Panel</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Pages
                    </li>

                    <?php
//current url
$current_url = $_SERVER['REQUEST_URI'];
?>

                    <li class="sidebar-item <?php if ($current_url == ROOT . "/admin/") {echo "active";}?> ">
                        <a class="sidebar-link" href="<?php echo ROOT ?>/admin">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item <?php if ($current_url == ROOT . "/admin/users/") {echo "active";}?> ">
                        <a class="sidebar-link" href="<?php echo ROOT ?>/admin/users">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Shop
                                Admins</span>
                        </a>
                    </li>
                    <li class="sidebar-item <?php if ($current_url == ROOT . "/admin/cost/") {echo "active";}?> ">
                        <a class="sidebar-link" href="<?php echo ROOT ?>/admin/cost">
                            <i class="align-middle" data-feather="menu"></i> <span class="align-middle">Cost</span>
                        </a>
                    </li>
                    <li class="sidebar-item <?php if ($current_url == ROOT . "/admin/services/") {echo "active";}?> ">
                        <a class="sidebar-link" href="<?php echo ROOT ?>/admin/services">
                            <i class="align-middle" data-feather="list"></i> <span class="align-middle">Services</span>
                        </a>
                    </li>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-bs-toggle="dropdown">
                                <span class="text-dark"> <?php echo $_SESSION['admin_name'] ?> </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <form method="POST" class="d-inline-flex w-100 justify-content-center">
                                    <button name="logout" class="btn btn-outline-info">Logout</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <?php
if (isset($_SESSION["success"]) && $_SESSION["success"] != "") {
    echo '<div class="alert alert-success p-2 text-center">' . $_SESSION["success"] . '</div>';
    unset($_SESSION["success"]);
}
if (isset($_SESSION["error"]) && $_SESSION["error"] != "") {
    echo '<div class="alert alert-danger p-2 text-center">' . $_SESSION["error"] . '</div>';
    unset($_SESSION["error"]);
}
?>