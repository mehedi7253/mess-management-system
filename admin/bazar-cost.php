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
                <li class="breadcrumb-item active">Manage Bazar's</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Manage Bazar Cost <a href="create-bazarcost.php" class="btn btn-primary float-right">Add Bazar</a> </h3>
                        </div>
                        <div class="card-body">
                            <?php
                                if(isset($_SESSION['success'])){
                                    echo "
                                            <div class='alert alert-success alert-dismissible'>
                                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                            <h6><i class='icon fa fa-check'></i> Success!</h6>
                                            ".$_SESSION['success']."
                                            </div>
                                        ";
                                    unset($_SESSION['success']);
                                }
                            ?>
                            <h5 class="text-primary">
                                Month: 
                                <?php
                                    $today = date('M');
                                    echo $today;

                                    $sql = "SELECT * FROM bazars, members WHERE bazars.member_id = members.id AND MONTH(date) = MONTH(CURRENT_DATE());                                    ";
                                    $res = mysqli_query($connect, $sql);
                                    $i = 1;

                                ?>
                            </h2>
                            <div class="table-responsive">
                                <table  class="table table-striped table-bordered"> 
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Member</th>
                                            <th>T.K</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                            while ($row = mysqli_fetch_assoc($res)){?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo @date('d', strtotime ($row['date']))?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo number_format($row['total'], 2); ?></td>
                                                    <td>
                                                    <a href="delete.php?delete_member=<?php echo $row['id']?>" onclick="return confirm('Are You Sure To Delete..!')" class="btn btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php }?>
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
        <?php include "front/sub_footer.php";?>
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->


    <?php include "front/footer.php";?>

</body>
</html>
