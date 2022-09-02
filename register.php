<?php include "./includes/global.php";?>
<?php
session_start();
if (isset($_SESSION['admin_id'])) {
    header("location: admin");
}
if (isset($_SESSION['shop_id'])) {
    header("location: shopadmin");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" type="text/css" href="<?php echo ROOT ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ROOT ?>/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
</head>

<body>
    <nav style="background-color: #315154;border: none;border-radius: 0;" class="navbar navbar-inverse">
        <div class="col-md-12">

            <div class="navbar-header logo-div">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo ROOT ?>">Print Logic.Co</a>
            </div>

            <div class="collapse navbar-collapse top-right-menu-ul" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right" style="margin-right: 10px;">

                    <li><a href="<?php echo ROOT ?>">Home</a></li>
                    <li><a href="<?php echo ROOT ?>/register.php">Register as Shop Admin</a></li>
                    <!-- <li><button class="sh-btn" onclick="toggleClass()">Register</button></li> -->
                    <li><a href="<?php echo ROOT ?>/login.php">Admin Login</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <?php
include './includes/connect.php';
$error = '';

if (isset($_POST['submit'])) {
    $n = $_POST['n'];
    $e = $_POST['e'];
    $p = $_POST['p'];
    $g = $_POST['g'];
    $pn = $_POST['pn'];
    $shop_name = $_POST['shop_name'];
    $shop_city = $_POST['shop_city'];
    $shop_address = $_POST['shop_address'];
    $shop_lat = $_POST['shop_lat'];
    $shop_lon = $_POST['shop_lon'];
    $easypaisa_number = $_POST['easypaisa'];
    $jazzcash_number = $_POST['jazzcash'];

    if (strlen($_POST['pn']) > 10) {
        if (preg_match("/^((?:00|\+)92)?(0?3(?:[0-46]\d|55)\d{7})$/", $_POST['pn'])) {

            $phNo = $_POST['pn'];
            $sql = "INSERT INTO shops(name,email,password,gender,phone_number,shop_name,shop_city,shop_address,shop_lat,shop_lon,easypaisa_number,jazzcash_number)
                	VALUES('$n','$e','$p','$g','$pn', '$shop_name', '$shop_city', '$shop_address', '$shop_lat', '$shop_lon', '$easypaisa_number', '$jazzcash_number')";
            if ($conn->query($sql) == true) {
                $_SESSION['success'] = "Regestered successfully";
                header("Location: login.php");
                exit();
            }
            $conn->close();
        } else {
            $error = "Invalid Number!";
        }
    } else {
        $error = "Invalid Number!";
    }
}
?>


    <div class="container" id="sources-form">
        <form action="" method="post" enctype="multipart/form-data">
            <h2 style="font-weight:bold;text-align: center;padding: 10px 0 10px 0;font-family: arial;">Register YourSelf
            </h2>
            <div class="form-group">
                <p class="col-md-12" style="text-align: left;">Name:
                    <input type="text" class="form-control sf-input" placeholder="Enter Name.." name="n" required>
                </p>
            </div>
            <div class="form-group">
                <p class="col-md-12" style="text-align: left;">Email:
                    <input type="email" class="form-control sf-input" placeholder="Email.." name="e" required>
                </p>
            </div>
            <div class="form-group">
                <p class="col-md-12" style="text-align: left;">Password:
                    <input type="password" class="form-control sf-input" placeholder="Enter Password.." name="p"
                        required>
                </p>
            </div>
            <div class="form-group">
                <p class="col-md-12" style="text-align: left;">Gender:
                    <select class="form-select sf-input" aria-label="Default select example" name="g" required>
                        <option value="">Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </p>
            </div>
            <div class="form-group">
                <p class="col-md-12" style="text-align: left;">Phone No:
                    <input type="text" class="form-control sf-input" placeholder="+92xxxxxxxxxx" maxlength="13"
                        name="pn" required>
                </p>
                <span style="color:red; padding-left:15px;"><?php echo $error; ?></span>
            </div>
            <div class="form-group">
                <p class="col-md-12" style="text-align: left;">Shop Name:
                    <input type="text" class="form-control sf-input" name="shop_name" id="shop_name" required>
                </p>
            </div>
            <div class="form-group">
                <p class="col-md-12" style="text-align: left;">Shop City:
                    <input type="text" class="form-control sf-input" name="shop_city" id="shop_city" required>
                </p>
            </div>
            <div class="form-group">
                <p class="col-md-12" style="text-align: left;">Shop Address:
                    <textarea name="shop_address" class="form-control sf-input" id="shop_address" cols="30"
                        rows="10"></textarea>
                </p>
            </div>
            <div class="form-group">
                <p class="col-md-12" style="text-align: left;">Shop Latitude:
                    <input type="text" class="form-control sf-input" name="shop_lat" id="shop_lat" required>
                </p>
            </div>
            <div class="form-group mb-4">
                <p class="col-md-12" style="text-align: left;">Shop Longitude:
                    <input type="text" class="form-control sf-input" name="shop_lon" id="shop_lon" required>
                </p>
            </div>
            <div class="form-group mb-4">
                <p class="col-md-12" style="text-align: left;">Easypaisa Number (Optional) (<small>Used for collecting
                        payments
                        through easypaisa</small>) :
                    <input type="text" class="form-control sf-input" name="easypaisa" id="easypaisa">
                </p>
            </div>
            <div class="form-group mb-4">
                <p class="col-md-12" style="text-align: left;">Jazzcash Number (Optional) (<small>Used for collecting
                        payments
                        through jazzcash</small>) :
                    <input type="text" class="form-control sf-input" name="jazzcash" id="jazzcash">
                </p>
            </div>
            <input class="form-control s-btn" type="submit" value="SUBMIT" name="submit">
        </form>
    </div>


    <style type="text/css">
    body {
        background-color: #f3f6f4;
    }

    #sources-form {
        width: 50%;
        background-color: #eee;
        padding: 10px 30px 40px 30px;
        line-height: 40px;
        margin-top: 140px;
        box-shadow: 5px 5px 30px 5px #0004;
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
        #sources-form {
            width: 60%;
            margin-top: 80px;
        }

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
</body>

</html>