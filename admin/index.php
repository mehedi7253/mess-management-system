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
               
                <div class="col-md-10 mx-auto">
                   <div class="table-responsive">
                       <table class="table table-bordered">
                           <thead>
                               <tr>
                                   <th>Item Name</th>
                                   <th>Item Price</th>
                               </tr>
                           </thead>
                           <tbody>
                               <?php
                                $sql = "SELECT * FROM weakly_bazars";
                                $res = mysqli_query($connect, $sql);
                                while($row = mysqli_fetch_assoc($res)){?>
                                    <td><?php echo $row['item_name'];?></td>
                                    <td><?php echo number_format($row['price'],2);?></td>
                                <?php }?>
                               <tr>

                               </tr>
                           </tbody>
                       </table>
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
