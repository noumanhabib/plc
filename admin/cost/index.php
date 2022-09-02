<?php require_once "./../../includes/global.php";?>

<?php
include_once '../main.php';
include_once "./../../includes/connect.php"

?>

<!-- Page php here -->
<?php
if (isset($_POST['update'])) {
    $rgb = $_POST['rgb'];
    $cmyk = $_POST['cmyk'];
    $grayscale = $_POST['grayscale'];

    //check if record available int extra_cost table
    $sql = "SELECT * FROM extra_cost;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $sql = "UPDATE extra_cost SET rgb = '$rgb', cmyk = '$cmyk', grayscale = '$grayscale' WHERE id = 1;";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION["success"] = "Labour cost updated successfully";
            header("location: .");
            exit();
        } else {
            echo "<script>alert('Error updating labour cost');</script>";
        }
    } else {
        $sql = "INSERT INTO extra_cost (rgb, cmyk) VALUES ('$rgb', '$cmyk', '$grayscale');";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION["success"] = "Labour cost updated successfully";
            header("location: .");
            exit();
        } else {
            echo "<script>alert('Error updating labour cost');</script>";
        }
    }

}

$sql = "SELECT * FROM extra_cost WHERE id = 1;";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $rgb = $row['RGB'];
    $cmyk = $row['CMYK'];
    $grayscale = $row['grayscale'];
} else {
    $rgb = "";
    $cmyk = "";
    $$grayscale = "";
}

?>

<?php include_once '../top.php'?>

<main class="content">



    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Update</strong> Labour Cost</h1>

        <form method="post">
            <!-- RGB, CMYK -->
            <div class="row">
                <div class="col-md-4 d-flex flex-column">
                    <label for="rgb">RGB Color Cost</label>
                    <input type="number" name="rgb" value="<?php echo $rgb ?>" id="rgb" class="w-100 px-2 py-2">
                </div>
                <div class="col-md-4 d-flex flex-column">
                    <label for="rgb">CMYK Color Cost</label>
                    <input type="number" name="cmyk" id="cmyk" value="<?php echo $cmyk ?>" class="w-100 px-2 py-2">
                </div>
                <div class="col-md-4 d-flex flex-column">
                    <label for="rgb">GrayScale Color Cost</label>
                    <input type="number" name="grayscale" id="grayscale" value="<?php echo $grayscale ?>"
                        class="w-100 px-2 py-2">
                </div>
            </div>

            <div class="w-100 d-flex justify-content-center mt-4 mb-4">
                <button class="btn btn-lg btn-primary" name="update" type="submit">Update</button>
            </div>

        </form>

    </div>
</main>

<?php include_once '../footer.php'?>
<?php include_once './down.php'?>