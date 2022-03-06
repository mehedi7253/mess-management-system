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
                <li class="breadcrumb-item active">Add Meal</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add Meal <a href="manage-meal.php" class="btn btn-primary float-right">Manage Meal</a> </h3>
                        </div>
                        <div class="card-body">
                
                            <?php
                                if (isset($_POST['btn']))
                                {
                                    foreach ($_POST['meal'] as $id => $meal) {

                                        $date        = $_POST['date'];
                                        $member_id   = $_POST['member_id'] [$id];
                                        $meal        = $_POST['meal'] [$id];

                                        $sql = "INSERT INTO meals (date,member_id,meal) values ('$date', '$member_id','$meal')";
                                        $res = mysqli_query($connect, $sql);
                                    }

                                    if ($res)
                                    {
                                        $_SESSION['success'] = 'Added Successful';
                                        echo "<script>document.location.href='manage-meal.php'</script>";
                                    }else{
                                        echo "<span class='text-danger'>Failed Try Again..!</span>";
                                    }
                                }
                            ?>
                            <form action="" method="POST">
                                <div class="form-group col-md-6 col-sm-12 float-left">
                                    <label>Date <sup class="text-danger font-weight-bold">*</sup></label>
                                    <input type="date" name="date" class="form-control" value="<?php if($_POST) {
                                        echo $_POST['date'];
                                    } ?>">
                                </div>
                               
                               <div class="table-responsive col-md-12 col-sm-12">
                                   <table class="table table-bordered">
                                       <thead>
                                           <tr>
                                               <th>Serial</th>
                                               <th>Member</th>
                                               <th>Meal</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                       <?php
                                            $sql = "SELECT * FROM members WHERE email != 'admin@gmail.com'";
                                            $res = mysqli_query($connect, $sql);
                                            $i = 1;
                                            while ($row = mysqli_fetch_assoc($res)){?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td>
                                                        <input name="member_id[]" hidden value="<?php echo $row['id'];?>">
                                                        <?php echo $row['name']; ?>
                                                    </td>
                                                    <td>
                                                        <input name="meal[]" type="checkbox" value="0"> 0 ,
                                                        <input name="meal[]" type="checkbox" value="1"> 1 ,
                                                        <input name="meal[]" type="checkbox" value="2"> 2 ,
                                                        <input name="meal[]" type="checkbox" value="3"> 3 ,
                                                        <input name="meal[]" type="checkbox" value="4"> 4 ,
                                                        <input name="meal[]" type="checkbox" value="5"> 5
                                                    </td>
                                                </tr>
                                            <?php }?>
                                       </tbody>
                                   </table>
                               </div>
                               <div class="form-group col-md-4">
                                   <input type="submit" name="btn" value="Submit" class="btn btn-success btn-block">
                               </div>
                            </form>
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
