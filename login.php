<?php
include './includes/connect.php';
include './includes/global.php';
session_start();
if (isset($_SESSION['admin_id'])) {
    header("location: admin");
}
if (isset($_SESSION['shop_id'])) {
    header("location: shopadmin");
}

if (isset($_POST['login'])) {
    $query = "SELECT * FROM `admins` WHERE `email` = '$_POST[email]' AND `password` = '$_POST[pswd]'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) >= 1) {
        //get result
        $row = mysqli_fetch_assoc($result);
        //set session
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_name'] = $row['name'];
        $_SESSION['admin_email'] = $row['email'];
        $_SESSION['AdminLoginId'] = $_POST['name'];
        header("location: admin");
    } else {
        $query2 = "SELECT * FROM `shops` WHERE `email` = '$_POST[email]' AND `password` = '$_POST[pswd]'";
        $result2 = mysqli_query($conn, $query2);
        if (mysqli_num_rows($result2) >= 1) {
            //get result
            $row2 = mysqli_fetch_assoc($result2);
            //set session
            $_SESSION['shop_id'] = $row2['id'];
            $_SESSION['shop_name'] = $row2['name'];
            $_SESSION['shop_email'] = $row2['email'];
            $_SESSION['ShopLoginId'] = $_POST['name'];
            header("location: shopadmin");
        } else {
            echo "<script>alert('Incorrect Username or Password');</script>";
            header("location: adminLogin.php");
            exit();
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Print Logic.co</title>
    <link rel="stylesheet" type="text/css" href="<?php echo ROOT ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" type="text/css" href="<?php echo ROOT ?>/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ROOT ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/animate.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style type="text/css">
    body {
        background-color: #f3f6f4;
    }

    #reg-form {
        width: 40%;
        background-color: #eee;
        padding: 10px 30px 40px 30px;
        line-height: 40px;
        box-shadow: 5px 5px 30px 5px #0004;
        margin-top: 180px;
    }

    .sh-btn {
        background: none;
        color: #fff;
        margin-top: 15px;
        border: none;
    }

    .register-info {
        background: #b5b5b5;
        color: #fff;
        padding: 0px 15px;
        font-weight: 400;
        margin: 15px 0 25px 0;
    }

    .reg-input {
        border: 1px solid #43bbec;
        margin-bottom: 20px;
    }

    .sf-input {
        border: 1px solid #43bbec;
        width: 100%;
        height: 35px;
        border-radius: 4px;
    }

    @media (max-width: 767px) {
        .s-btn {
            width: 35%;
        }

        #reg-form {
            width: 60%;
            margin-top: 80px;
        }

        #reg-form h2 {
            font-size: 25px;
        }
    }
    </style>

</head>

<body>
    <!-- <div class="header-img"> -->
    <nav style="background-color: #315154;border: none;border-radius: 0;" class="navbar navbar-default">
        <!-- <div class="container"> -->

        <div class="navbar-header logo-div">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Print Logic.Co</a>
        </div>
        <div class="collapse navbar-collapse top-right-menu-ul" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right" style="margin-right: 10px;">

                <li><a href="<?php echo ROOT ?>">Home</a></li>
                <!-- <li><button class="sh-btn" onclick="show_hide()">Sources</button></li>
        <li><button class="sh-btn" onclick="toggleClass()">Register</button></li> -->
                <li><a href="login.php">Admin Login</a></li>
            </ul>
        </div>
    </nav>

    <!-- Register Form -->
    <div class="container" id="reg-form">
        <h2 style="text-align:center;font-weight: bold;padding: 5px 0 30px 0;">Admin Login Here</h2>
        <form method="post" class="fcorn-register">
            <p class="register-info">Note: All fields are required.</p>
            <div class="row">
                <p class="col-md-12"><input class="form-control reg-input" type="email" name="email" placeholder="Email"
                        required></p>
            </div>

            <div class="row">
                <p class="col-md-12"><input class="form-control reg-input" style="margin-top: 10px;" type="Password"
                        name="pswd" placeholder="Password" required></p>
            </div>
            <div class="">
                <input class="form-control rg-btn" type="submit" name="login" value="Sign In">
            </div>
        </form>
    </div>
    </div>

    <!-- close Register Form -->

    <script type="text/javascript" src="<?php echo ROOT ?>/assets/js/jquery-main.js"></script>
    <script type="text/javascript" src="<?php echo ROOT ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo ROOT ?>/assets/js/wow.min.js"></script>

    <script>
    new WOW().init();
    </script>
    <script type="text/javascript" src="<?php echo ROOT ?>/assets/js/showhide.js"></script>


</body>

</html>