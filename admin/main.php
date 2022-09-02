<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("location:" . ROOT . "/login.php");
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("location:" . ROOT . "/login.php");
}

function uploadFileToServer($file, $destination_folder = "upload", $ALLOWED_EXTENSION = ['jpg', 'png', 'jpeg'])
{
    if ($file) {
        $filename = $file['name'];
        $filepath = $file['tmp_name'];
        $fileerror = $file['error'];
        $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($file_extension, $ALLOWED_EXTENSION)) {
            return [
                "success" => false,
                "message" => "Invalid File type. Only JPG, PNG, JPEG and PDF are allowed.",
            ];
        }
        if ($fileerror != 0) {
            return [
                "success" => false,
                "message" => "File upload error.",
            ];
        }
        $fileNewName = 'upload/' . time() . $filename;
        $destfile = __DIR__ . './../' . $fileNewName;
        if (move_uploaded_file($filepath, $destfile)) {
            return [
                "success" => true,
                "file" => $fileNewName,
            ];
        } else {
            return [
                "success" => false,
                "message" => "File move error.",
            ];
        }
    } else {
        return [
            "success" => false,
            "message" => "File not found.",
        ];
    }

}