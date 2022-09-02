<?php require_once "./../../includes/global.php";?>

<?php
include_once '../main.php';
include_once "./../../includes/connect.php"

?>

<!-- Page php here -->
<?php

$fields = [
    [
        "name" => "Name",
        "type" => "text",
    ],
    [
        "name" => "Image",
        "type" => "image",
    ],
    [
        "name" => "Price",
        "type" => "number",
    ],
];

$table = "services";

if (isset($_POST['insert'])) {
    $sql = "INSERT INTO {$table} (";
    foreach ($fields as $i => $field) {
        $name = strtolower($field['name']);
        if ($i === sizeof($fields) - 1) {
            $sql .= $name . ") ";
        } else {
            $sql .= $name . ", ";
        }
    }
    $sql .= "VALUES (";
    foreach ($fields as $i => $field) {
        $name = strtolower($field['name']);
        if (isset($_POST[$name]) && empty($_POST[$name])) {
            $_SESSION["error"] = $field['name'] . " field is required";
            header("location: .");
            break;
            exit();
        }
        if ($field['type'] == "image") {
            $result = uploadFileToServer($_FILES[$name]);
            var_dump($result);
            if ($result['success'] === false) {
                $_SESSION["error"] = $result['message'];
                header("location: .");
                break;
                exit();
            } else {
                $value = $result['file'];
            }
        } else {
            $value = $_POST[$name];
        }
        if ($i === sizeof($fields) - 1) {
            $sql .= "'{$value}' );";
        } else {
            $sql .= "'{$value}', ";
        }
    }

    if ($conn->query($sql) == true) {
        $_SESSION['success'] = "Record saved successfully";
        header("Location: .");
        exit();
    } else {
        $_SESSION['error'] = "Database error. Not able to save into database";
        header("Location: .");
        exit();
    }

}

if (isset($_POST['delete'])) {
    $id = isset($_POST['delid']) ? (int) $_POST['delid'] : null;

    if ($id && is_int($id)) {
        $sql = "DELETE FROM {$table} WHERE id = {$id};";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION["success"] = "Service deleted successfully";
            header("location: .");
            exit();
        } else {
            $_SESSION["error"] = "Error while deleting service";
            header("location: .");
            exit();
        }
    } else {
        header("Location: .");
        exit();
    }
}

$sql = "SELECT * FROM services;";
$result = mysqli_query($conn, $sql);

?>


<?php include_once '../top.php'?>

<main class="content">
    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-3"><strong>Shop</strong> Services</h1>
            <button data-bs-toggle="modal" data-bs-target="#addModel" class="btn btn-outline-primary">Add New
                Service</button>
        </div>

        <div class="table-responsive mt-4">
            <table id="default-datatable" class="table table-striped">
                <thead>
                    <tr>
                        <?php foreach ($fields as $field) {?>
                        <th> <?php echo $field["name"] ?> </th>
                        <?php }?>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <?php foreach ($fields as $field) {?>
                        <th> <?php echo $field["name"] ?> </th>
                        <?php }?>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    foreach ($fields as $field) {
        $name = strtolower($field["name"]);
        if ($field["type"] == "image") {
            echo "<td> <img width='40px' height='40px' src='". ROOT ."/{$row[$name]}' /> </td>";
        } else {
            echo "<td>{$row[$name]}</td>";
        }
    }
    echo "<td>";
    echo "<button onclick=\"$('#delid').val({$row['id']})\" data-bs-toggle='modal' data-bs-target='#delModel' class='btn btn-danger'>Delete</button>";
    echo "</td>";
    echo "</tr>";
}
?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="delModel" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST">
            <input type="hidden" name="delid" id="delid" class="d-none">
            <div class="modal-body d-flex flex-column align-items-center">
                <div class="w-100 d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="w-100 d-flex justify-content-center mt-2 mb-5">
                    <h1 class="modal-title" id="exampleModalLabel2">Do you want to delete record</h1>
                </div>
                <button type="submit" name="delete" class="btn btn-danger mt-5 mb-4">Delete</button>
            </div>

        </form>
    </div>
</div>

<div class="modal fade" id="addModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <?php foreach ($fields as $field) {?>

                <?php $name = strtolower($field['name']);?>
                <?php if ($field["type"] == "image") {?>
                <div class="d-flex flex-column mb-3" style="gap: 0.2rem;">
                    <label for="<?php echo $field['name'] ?>"> Choose <?php echo $field['name'] ?> </label>
                    <input type="file" name="<?php echo $name ?>" accept="image/*" class="w-100" required>
                </div>
                <?php } else {?>
                <div class="d-flex flex-column mb-3" style="gap: 0.2rem;">
                    <label for="<?php echo $name ?>"> Enter <?php echo $field['name'] ?> </label>
                    <input type="<?php echo $field['type'] ?>" name="<?php echo $name ?>" class="w-100 px-2 py-2"
                        required>
                </div>
                <?php }?>

                <?php }?>

            </div>
            <div class="modal-footer">
                <button type="submit" name="insert" class="btn btn-primary">Insert</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>

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