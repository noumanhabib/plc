<?php include './includes/global.php';?>

<!DOCTYPE html>
<html>

<?php include "./layouts/head.php"?>

<body>

    <?php include "./layouts/header.php"?>

    <div class="container">
        <h3 class="text-center mb-5">Receipt</h3>
        <div class="receipt pt-5">
            <?php
require_once "./includes/connect.php";
//get inserted_print_type_id from cookie

$inserted_print_type_cookie = isset($_COOKIE['inserted_print_type_id']) ? $_COOKIE['inserted_print_type_id'] : null;
$inserted_print_type_ids = json_decode($inserted_print_type_cookie);
if (is_int($inserted_print_type_ids)) {
    $inserted_print_type_ids = [$inserted_print_type_ids];
}
$idsString = "";
for ($i = 0; $i < sizeof($inserted_print_type_ids); $i++) {
    $idsString .= $inserted_print_type_ids[$i];
    if ($i < sizeof($inserted_print_type_ids) - 1) {
        $idsString .= ", ";
    }
}
if ($inserted_print_type_ids) {
    $sql = "SELECT * FROM print_request WHERE id IN ($idsString);";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        $costSql = "SELECT * FROM extra_cost;";
        $costResult = mysqli_query($conn, $costSql);
        $costRow = mysqli_fetch_assoc($costResult);
        $rgbCost = $costRow['RGB'];
        $cmykCost = $costRow['CMYK'];

        $shop_id = $row["shop_id"];
        $shopSql = "SELECT * FROM shops where id= '$shop_id'";
        $shopResult = mysqli_query($conn, $shopSql);
        $shopRow = mysqli_fetch_assoc($shopResult);

        ?>
            <div class=" table-responsive" style="margin-top: 5rem;">
                <table class='table table-hover' style='text-align:center'>
                    <tr>
                        <th>Product Size</th>
                        <th>Quantity</th>
                        <th>Paper Quality</th>
                        <th>Color Scheme</th>
                        <th>Cost</th>
                        <th>Phone Number</th>
                        <th>Design</th>
                        <th>Status</th>
                        <th>Shop Name</th>
                        <th>Shop Contact</th>
                    </tr>
                    <tr>
                        <td> <?php echo $row['size'] ?></td>
                        <td> <?php echo $row["quantity"] ?></td>
                        <td> <?php echo $row["paper_quality"] ?></td>
                        <td> <?php echo $row["color_scheme"] ?></td>
                        <td> <?php if ($row["color_scheme"] === "RGB") {
            echo ($rgbCost * $row["quantity"]);
        } else {
            echo ($cmykCost * $row["quantity"]);
        }
        ?>
                        </td>
                        <td> <?php echo $row["phone_number"] ?></td>
                        <td> <img src="<?php echo $row["design"] ?>" width="100px" height="50px"></td>
                        <td>
                            <?php if ($row['is_done'] == '1') {?>
                            <span class="btn btn-success" title="You can take your design from shop">Printed</span>
                            <?php } else {?>
                            <span class="btn btn-secondary" title="Wait. Will printed soon">Not Printed</span>
                            <?php }?>
                        </td>
                        <td> <?php echo $shopRow['name'] ?> </td>
                        <td> <?php echo $shopRow['phone_number'] ?> </td>
                    </tr>
                </table>
            </div>

            <?php
}

} else {
    echo "0 results found.";
}
?>
            <br><br><br>
        </div>
        <h6 style="text-align: right;">Print Logic.Co</h6>
    </div>

    <?php include "./layouts/scripts.php"?>

</body>

</html>