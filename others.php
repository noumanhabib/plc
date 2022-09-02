<?php
session_start();
include_once "./includes/global.php";
include_once "./includes/connect.php";
?>

<!DOCTYPE html>
<html>

<?php include "./layouts/head.php"?>

<body style="background-color: #f3f6f4;">
    <?php include "./layouts/header.php"?>



    <div class="" id="sf">
        <div class="container" id="sources-form">

            <form action="<?php echo ROOT ?>/insert_print_request.php" method="post" enctype="multipart/form-data">


                <p class="register-info" style="text-align: left;">Note: All fields are required.</p>

                <div class="form-group">
                    <p class="col-md-12" style="text-align: left;"> Other Services:
                        <input type="text" class="form-control sf-input" placeholder="abc..." name="service_type"
                            required>
                    </p>
                </div>

                <?php include "./includes/input_form.php"?>
                <?php include "./includes/choose_shop.php"?>

                <input class="form-control s-btn" type="submit" value="SUBMIT" name="submit">
            </form>
        </div>
    </div>

    <?php include "./layouts/scripts.php"?>

</body>

</html>