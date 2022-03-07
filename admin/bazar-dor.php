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
                    <li class="breadcrumb-item active">Add Bazar Dor</li>
                </ol>

                <!-- Icon Cards-->
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h3>Add Bazar Dor <a href="manage-bazar-dor.php" class="btn btn-primary float-right">Manage Bazar Dor</a> </h3>
                            </div>
                            <div class="card-body">

                                <?php
                                if (isset($_POST['btn'])) {

                                    $item_name   = $_POST['item_name'];
                                    $price        = $_POST['price'];

                                    if ($item_name == '') {
                                        echo "<span class='text-danger'>Please Enter Item Name</span>";
                                    } elseif ($price == '') {
                                        echo "<span class='text-danger'>Please Enter Item Price</span>";
                                    } else {
                                        $sql = "INSERT INTO weakly_bazars (item_name,price) values ('$item_name', '$price')";
                                        $res = mysqli_query($connect, $sql);

                                        if ($res) {
                                            $_SESSION['success'] = 'Added Successful';
                                            echo "<script>document.location.href='manage-bazar-dor.php'</script>";
                                        } else {
                                            echo "<span class='text-danger'>Failed Try Again..!</span>";
                                        }
                                    }
                                }
                                ?>
                                <form action="" method="POST">

                                    <div class="form-group col-md-6 col-sm-12 float-left">
                                        <label>Item Name <sup class="text-danger font-weight-bold">*</sup></label>
                                        <input type="text" name="item_name" class="form-control" placeholder="Enter Item Name" value="<?php if ($_POST) {
                                                echo $_POST['item_name'];
                                            } ?>">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12 float-left">
                                        <label>Item Price <sup class="text-danger font-weight-bold">*</sup></label>
                                        <input type="text" name="price" min="1" class="form-control" placeholder="Enter Price" value="<?php if ($_POST) {
                                                echo $_POST['price'];
                                            } ?>">
                                    </div>
                                    <div class="form-group col-md-4 col-sm-12 float-left">
                                        <input type="submit" name="btn" class="btn btn-block btn-success" value="Submit">
                                    </div>
                                </form>
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