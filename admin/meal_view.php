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
                    <li class="breadcrumb-item active">Meal Details</li>
                </ol>

                <!-- Icon Cards-->
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h3>Meal Details <a href="manage-meal.php" class="btn btn-primary float-right">Manage Meal</a> </h3>
                            </div>
                            <div class="card-body">

                                <?php
                                if (isset($_GET['meal'])) {
                                    $meal_date = $_GET['meal'];
                                    $meal = "SELECT * FROM meals,members WHERE meals.member_id = members.id AND date = '$meal_date'";
                                    $res  = mysqli_query($connect, $meal);
                                    // $data = mysqli_fetch_assoc($res);
                                }
                                ?>
                                <form action="" method="POST">
                                    <div class="form-group col-md-6 col-sm-12 float-left">
                                        <label>Date <sup class="text-danger font-weight-bold">*</sup></label>
                                        <input type="date" name="date" class="form-control" value="<?php echo $meal_date; ?>">
                                    </div>
                                    <div class="table-responsive col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Serial</th>
                                                    <th>Member</th>
                                                    <th>Day</th>
                                                    <th>Night</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                while ($data = mysqli_fetch_assoc($res)) { ?>
                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td class="text-capitalize">
                                                            <?php echo $data['name']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $data['day_meal']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $data['night_meal']; ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
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