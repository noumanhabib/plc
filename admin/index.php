<?php require_once "./../includes/global.php"; ?>
<?php include_once './main.php'?>
<?php include_once './top.php'?>
<?php include_once './../includes/connect.php'; ?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

        <div class="row">
            <div class="col-xl-12 col-xxl-12 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Sales</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="truck"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">
                                        <?php
                                            $sql = "SELECT COUNT(*) AS total FROM print_request;";
                                            $result = mysqli_query($conn, $sql);
                                            $row = mysqli_fetch_assoc($result);
                                            echo $row['total'];
                                        ?>
                                    </h1>
                                    
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Shops</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">
                                        <?php
                                            $sql = "SELECT count(id) as total FROM shops;";
                                            $result = mysqli_query($conn, $sql);
                                            $row = mysqli_fetch_assoc($result);
                                            echo $row["total"];
                                        ?>
                                    </h1>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Earnings</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">
                                        <?php
                                            $sql = "SELECT quantity, color_scheme FROM print_request;";
                                            $result = mysqli_query($conn, $sql);
                                            $total_earning = 0;
                                            $color_value_sql = "SELECT * FROM extra_cost;";
                                            $colorResult = mysqli_query($conn, $color_value_sql);
                                            $colorRow = mysqli_fetch_assoc($colorResult);

                                            while($row = mysqli_fetch_assoc($result)){
                                                $quantity =  (int)$row['quantity'];
                                                $colorScheme = $row["color_scheme"];
                                                $colorPrice = isset($colorRow[$colorScheme]) ? (float)$colorRow[$colorScheme] : 0;
                                                $total_earning += $colorPrice * $quantity;
                                            }

                                            echo $total_earning;
                                        ?>
                                    </h1>
                                    
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Labout Costs</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="shopping-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">
                                        <?php
                                            $sql = "SELECT * FROM extra_cost;";
                                            $result = mysqli_query($conn, $sql);
                                            $row = mysqli_fetch_assoc($result);
                                        ?>
                                        <span> CMYK: <?php  echo $row["CMYK"]; ?> </span>
                                        <span> RGB: <?php  echo $row["RGB"]; ?> </span>
                                    </h1>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once './footer.php'?>
<?php include_once './down.php'?>
