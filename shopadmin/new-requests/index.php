<?php
require_once "./../../includes/global.php";
include_once '../main.php';
include_once './../../includes/connect.php';
?>

<!-- Page php here -->
<?php

if (isset($_POST['is_done'])) {
    $id = $_POST['id'];
    $sql = "UPDATE print_request SET is_done=1 WHERE id = '$id';";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION["success"] = "Request updated successfully";
        header("location: .");
        exit();
    } else {
        echo "<script>alert('Error updating the request');</script>";
    }
}

$sql = "SELECT * FROM print_request where shop_id=$shop_id AND is_done=0;";
$result = mysqli_query($conn, $sql);
?>


<?php include_once '../top.php'?>

<main class="content">



    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>New</strong> Requests</h1>

        <div class="table-responsive">
            <table id="default-datatable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Paper Quality</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Color Scheme</th>
                        <th>Customer Contact</th>
                        <th>Design File</th>
                        <th>Payment Method</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Type</th>
                        <th>Paper Quality</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Color Scheme</th>
                        <th>Customer Contact</th>
                        <th>Design File</th>
                        <th>Payment Method</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$row['type']}</td>";
    echo "<td>{$row['paper_quality']}</td>";
    echo "<td>{$row['size']}</td>";
    echo "<td>{$row['quantity']}</td>";
    echo "<td>{$row['color_scheme']}</td>";
    echo "<td>{$row['phone_number']}</td>";
    echo "<td>";
    echo "<a class='btn btn-primary' href='" . ROOT . "/{$row['design']}' download> Download </a>";
    echo "</td>";
    echo "<td>{$row['payment_method']}</td>";
    echo "<td>";
    echo "<form method='post' class='d-inline'> <input type='hidden' name='id' value='{$row['id']}'>";
    echo "<button name='is_done' value='1' class='btn btn-success'>Done</button>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
?>
                </tbody>
            </table>
        </div>

    </div>
</main>

<?php include_once '../footer.php'?>

<script>
$(document).ready(function() {
    $('#default-datatable').DataTable({
        columnDefs: [{
            orderable: false,
            targets: -1
        }],
    });
});
</script>

<?php include_once './../down.php'?>