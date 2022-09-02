<?php
$sql = "SELECT * FROM services;";

$servername2 = "localhost";
$username2 = "root";
$password2 = "";
$database2 = "plc";

$conn2 = mysqli_connect($servername2, $username2, "", $database2) or die("Unable to connect to database");

$result = mysqli_query($conn2, $sql);

class Service
{}

$services = array();
while ($row = mysqli_fetch_assoc($result)) {
    $s = new Service;
    $s->name = $row['name'];
    $s->image = $row['image'];
    $s->price = $row['price'];

    array_push($services, $s);
}

$conn2->close();

?>

<nav style="background-color: #315154;border: none;border-radius: 0; margin-bottom: 0;" class="navbar navbar-inverse">
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
            <ul class="nav navbar-nav navbar-right " style="margin-right: 10px; display:flex; align-items:center">

                <li><a href="<?php echo ROOT ?>">Home</a></li>
                <li><a href="<?php echo ROOT ?>/design">Design</a></li>

                <li>
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"
                            style="background: none;border: none;padding: 0;padding-inline: 10px;">
                            Services
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <?php foreach ($services as $service) {?>
                            <li><a style="color: black !important;"
                                    href="<?php echo ROOT ?>/service.php?name=<?php echo $service->name ?>">
                                    <?php echo $service->name ?> </a></li>
                            <?php }?>
                        </ul>
                    </div>
                </li>
                <li><a href="<?php echo ROOT ?>/others.php">Others</a></li>
                <li><a href="<?php echo ROOT ?>/receipts.php">Receipts</a></li>

                <li><a href="register.php">Apply for Admin</a></li>
                <li><a href="login.php">Admin Login</a></li>
            </ul>
        </div>
    </div>
</nav>
<?php if (isset($_SESSION['error'])) {?>
<div class="container">
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['error'] ?>
        <?php unset($_SESSION['error'])?>
    </div>
</div>
<?php }?>
<?php if (isset($_SESSION['success'])) {?>
<div class="container">
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['success'] ?>
        <?php unset($_SESSION['success'])?>
    </div>
</div>
<?php }?>