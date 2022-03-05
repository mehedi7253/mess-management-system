<?php
    session_start();
    if (!isset($_SESSION['admin_email'])){
        header('Location: ../index.php');
    }

    require_once '../db/db_connect.php';

    $sql = $connect->query("SELECT * FROM members WHERE email = '$_SESSION[admin_email]'");

    $user_data = mysqli_fetch_assoc($sql);
?>

<?php include "front/header.php"; ?>

<body id="page-top">

<?php include "front/nav.php";?>



<div id="wrapper">
   <?php include "front/sidebar.php";?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Overview</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-xl-4 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-comments"></i>
                            </div>
                            <div class="mr-5">
                              
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="manage-member.php">
                            <span class="float-left">Total Meal</span>
                            <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                        </a>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6 mb-3">
                    <div class="card text-white bg-secondary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-list"></i>
                            </div>
                            <div class="mr-5">
                               
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="manage-booking.php">
                            <span class="float-left">Total Bazar</span>
                            <span class="float-right">
                  <i class="fas fa-angle-right"></i></span></a>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6 mb-3">
                    <div class="card text-white bg-info o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-list"></i>
                            </div>
                            <div class="mr-5">
                              
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="tour-booking.php">
                            <span class="float-left">Month</span>
                            <span class="float-right">
                  <i class="fas fa-angle-right"></i></span></a>
                    </div>
                </div>


               


                <div class="col-xl-4 col-sm-6 mb-3">
                   
                </div>


            </div>
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php include "front/sub_footer.php";?>
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->


    <?php include "front/footer.php";?>

</body>
</html>
