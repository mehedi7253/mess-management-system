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
                    <li class="breadcrumb-item active">Update Meal</li>
                </ol>

                <!-- Icon Cards-->
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h3>Update Meal <a href="manage-meal.php" class="btn btn-primary float-right">Manage Meal</a> </h3>
                            </div>
                            <div class="card-body">

                                <?php
                                if (isset($_GET['meal_date'])) {
                                    $meal_date = $_GET['meal_date'];
                                    $meal = "SELECT * FROM meals,members WHERE meals.member_id = members.id AND date = '$meal_date'";
                                    $res  = mysqli_query($connect, $meal);
                                    $i = 1;
                                }
                                if (isset($_POST['btn'])) {
                                    foreach ($_POST['member_id'] as $id => $meal) {

                                        $date        = $_POST['date'];
                                        $day_meal    = $_POST['day_meal'][$id];
                                        $night_meal  = $_POST['night_meal'][$id];

                                        $sql = "UPDATE meals SET date = '$date',  day_meal = '$day_meal', night_meal = '$night_meal' WHERE date = '$meal_date'";
                                        $res = mysqli_query($connect, $sql);
                                    }

                                    if ($res) {
                                        $_SESSION['success'] = 'Added Successful';
                                        echo "<script>document.location.href='manage-meal.php'</script>";
                                    } else {
                                        echo "<span class='text-danger'>Failed Try Again..!</span>";
                                    }
                                }
                                ?>
                                <form action="" method="POST">
                                    <div class="form-group col-md-6 col-sm-12 float-left">
                                        <label>Date <sup class="text-danger font-weight-bold">*</sup></label>
                                        <input type="date" name="date" class="form-control" value="<?php echo $meal_date ?>">
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
                                                while ($row = mysqli_fetch_assoc($res)) { ?>
                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td class="text-capitalize">
                                                            <input name="member_id[]" hidden value="<?php echo $row['id']; ?>">
                                                            <?php echo $row['name']; ?>
                                                        </td>
                                                        <td>
                                                            <input name="day_meal[]" type="number" class="form-control" min="0" value="<?php echo $row['day_meal'] ?>">
                                                        </td>
                                                        <td>
                                                            <input name="night_meal[]" type="number" min="0" value="<?php echo $row['night_meal'] ?>" class="form-control">
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="submit" name="btn" value="Update" class="btn btn-success btn-block">
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