<?php
session_start();
include "./includes/connect.php";
include "./includes/global.php";
$service_name = isset($_GET["name"]) ? $_GET["name"] : null;
if (!$service_name) {
    header("Location: index.php");
    exit();
}
$sql = "SELECT * FROM services WHERE `name` LIKE '%{$service_name}%'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if (!$row) {
    header("Location: index.php");
    exit();
}
$service_price = $row['price'];
?>


<!DOCTYPE html>
<html>

<?php include "./layouts/head.php"?>

<body style="background-color: #f3f6f4;">
    <?php include "./layouts/header.php"?>


    <div id="sf">
        <div class="container" id="sources-form">
            <h2 style="font-weight: bold;"> <?php echo $service_name ?> </h2>

            <form action="<?php echo ROOT ?>/insert_print_request.php" method="post" enctype="multipart/form-data">

                <p class="register-info" style="text-align: left;">Note: All fields are required.</p>

                <input type="hidden" name="service_type" value="<?php echo $service_name ?>" style="display: none;">

                <?php include "./includes/input_form.php"?>
                <?php include "./includes/choose_shop.php"?>

                <input class="form-control s-btn" type="submit" value="SUBMIT" name="submit">
            </form>
        </div>
    </div>

    <?php include "./layouts/scripts.php"?>

</body>

</html>