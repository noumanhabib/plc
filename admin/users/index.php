<?php require_once "./../../includes/global.php";?>

<?php

include_once '../main.php';
include_once "./../../includes/connect.php"

?>

<!-- Page php here -->
<?php

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM shops WHERE id = '$id';";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION["success"] = "user deleted successfully";
        header("location: .");
        exit();
    } else {
        echo "<script>alert('Error deleting user');</script>";
    }
}

$sql = "SELECT * FROM shops;";
$result = mysqli_query($conn, $sql);

?>

<?php include_once '../top.php'?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Shop</strong> Admins</h1>

        <div class="table-responsive">
            <table id="default-datatable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['phone_number']}</td>";
    echo "<td>";
    echo "<form method='post' class='d-inline'> <input type='hidden' name='id' value='{$row['id']}'>";
    echo "<button name='delete' class='btn btn-danger'>Delete</button>";
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

<?php include_once '../down.php'?>