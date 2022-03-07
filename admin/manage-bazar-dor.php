<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
    header('Location: ../index.php');
}

require_once '../db/db_connect.php';

$sql = $connect->query("SELECT * FROM members WHERE email = '$_SESSION[admin_email]'");

$user_data = mysqli_fetch_assoc($sql);
?>

<?php include "front/header.php"; ?>

<body id="page-top">

    <?php include "front/nav.php"; ?>



    <div id="wrapper">
        <?php include "front/sidebar.php"; ?>

        <div id="content-wrapper">

            <div class="container-fluid">

                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Manage Bazar Dor</li>
                </ol>

                <!-- Icon Cards-->
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h3>Manage Bazar Dor <a href="bazar-dor.php" class="btn btn-primary float-right">Add Bazar Dor</a> </h3>
                            </div>
                            <div class="card-body">
                                <?php
                                if (isset($_SESSION['success'])) {
                                    echo "
                                            <div class='alert alert-success alert-dismissible'>
                                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                            <h6><i class='icon fa fa-check'></i> Success!</h6>
                                            " . $_SESSION['success'] . "
                                            </div>
                                        ";
                                    unset($_SESSION['success']);
                                }
                                ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item Name</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM weakly_bazars";
                                            $res = mysqli_query($connect, $sql);
                                            $i = 1;

                                            while ($row = mysqli_fetch_assoc($res)) { ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $row['item_name'] ?></td>
                                                    <td><?php echo number_format($row['price'], 2); ?></td>
                                                    <td>
                                                        <a href="update-bazar-dor.php?dor_id=<?php echo $row['id'] ?>" class="btn btn-info">Edit</a>
                                                        <a href="delete.php?dor_id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

            <!-- Sticky Footer -->
            <?php include "front/sub_footer.php"; ?>
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->


    <?php include "front/footer.php"; ?>


</body>

</html>