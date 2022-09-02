<?php
session_start();
include "./includes/global.php";
include "./includes/connect.php";

$ALLOWED_IMAGE_EXTENSION = array(
    "png",
    "jpg",
    "jpeg",
    "pdf",
);

if (isset($_POST['submit'])) {
    $services = $_POST['service_type'];
    $size = $_POST['size'];
    $quantity = (int) $_POST['quantity'] ?? 0;
    $paper_quality = $_POST['paper_quality'];
    $color_scheme = $_POST['color_scheme'];
    $phone_number = $_POST['phone_number'];
    $shop_id = $_POST['shop'];
    $payment_method = $_POST['payment_method'];

    if (empty($services) || !is_string($services) || (is_string($services) && strlen($services) < 2)) {
        $_SESSION['error'] = "Service Type field is required";
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
    if (empty($size) || !is_string($size) || (is_string($size) && strlen($size) < 2)) {
        $_SESSION['error'] = "Product Size field is required";
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
    if (empty($quantity) || !is_integer($quantity) || (is_int($quantity) && $quantity < 1)) {
        $_SESSION['error'] = "Quantity must be greater then 0";
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
    if (empty($paper_quality) || !is_string($paper_quality) || (is_string($paper_quality) && strlen($paper_quality) < 2)) {
        $_SESSION['error'] = "Paper Quality field is required";
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
    if (empty($phone_number) || !preg_match("/^((?:00|\+)92)?(0?3(?:[0-46]\d|55)\d{7})$/", $phone_number)) {
        $_SESSION['error'] = "Phone number field is required with format +92xxxxxxxxxx";
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }

    $file = $_FILES['design'];
    $filename = $file['name'];
    $filepath = $file['tmp_name'];
    $fileerror = $file['error'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
    if (!in_array($file_extension, $ALLOWED_IMAGE_EXTENSION)) {
        $_SESSION['error'] = "Invalid File type. Only JPG, PNG, JPEG and PDF are allowed.";
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
    if ($fileerror != 0) {
        $_SESSION['error'] = "File upload error";
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
    $destfile = 'upload/' . $filename;
    move_uploaded_file($filepath, $destfile);

    $sql = "INSERT INTO print_request(type,paper_quality,size,quantity,color_scheme,phone_number,design,shop_id,payment_method) VALUES('$services','$paper_quality','$size','$quantity','$color_scheme','$phone_number','$destfile', '$shop_id', '$payment_method')";
    if ($conn->query($sql) == true) {
        //Get last inserted record id
        $last_id = $conn->insert_id;
        //Save $last_id into cookie for future use for 1year
        $value = isset($_COOKIE["inserted_print_type_id"]) ? $_COOKIE["inserted_print_type_id"] : "[]";
        $jsonValues = json_decode($value);
        if (is_int($jsonValues)) {
            $jsonValues = [$jsonValues];
        }
        array_push($jsonValues, $last_id);
        $stringValue = json_encode($jsonValues);
        setcookie("inserted_print_type_id", $stringValue, time() + (86400 * 30 * 12), "/");
        header("location: receipts.php");
    } else {
        $_SESSION['error'] = "Database error. Not able to save into database";
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
    $conn->close();

} else {
    header("Location: " . ROOT);
}