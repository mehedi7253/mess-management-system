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
                <li class="breadcrumb-item active">Add Bazar Cost</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add Bazar Cost <a href="bazar-cost.php" class="btn btn-primary float-right">Manage Bazar Cost</a> </h3>
                        </div>
                        <div class="card-body">
                
                            <?php
                                if (isset($_POST['btn']))
                                {

                                    $member_id   = $_POST['member_id'];
                                    $date        = $_POST['date'];
                                    $total       = $_POST['total'];
                                    $description = $_POST['description'];

                                    if($member_id == ''){
                                       echo "<span class='text-danger'>Please Select Member</span>";
                                    }elseif($date == '')
                                    {
                                        echo "<span class='text-danger'>Please Select Date</span>";
                                    }elseif($total == '')
                                    {
                                        echo "<span class='text-danger'>Please Enter Total Amount</span>";
                                    }else{
                                        $sql = "INSERT INTO bazars (member_id,date,total,description) values ('$member_id', '$date','$total','$description')";
                                        $res = mysqli_query($connect, $sql);

                                        if ($res)
                                        {
                                            $_SESSION['success'] = 'Added Successful';
                                            echo "<script>document.location.href='bazar-cost.php'</script>";
                                        }else{
                                            echo "<span class='text-danger'>Failed Try Again..!</span>";
                                        }
                                    }
                                }
                            ?>
                            <form action="" method="POST">
                                <div class="form-group col-md-6 col-sm-12 float-left">
                                    <label>Member Name <sup class="text-danger font-weight-bold">*</sup></label>
                                    <?php
                                        $members = "SELECT * FROM members WHERE email != 'admin@gmail.com'";
                                        $sql_members = mysqli_query($connect, $members);
                                    ?>
                                    <select class="form-control" name="member_id">
                                        <option>------Select Member-------</option>
                                        <?php
                                            while($row = mysqli_fetch_assoc($sql_members)){?>
                                                <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                                            <?php }?>
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-12 float-left">
                                    <label>Date <sup class="text-danger font-weight-bold">*</sup></label>
                                    <input type="date" name="date" class="form-control" value="<?php if($_POST){
                                        echo $_POST['date'];
                                    }?>">
                                </div>
                               
                                <div class="form-group col-md-12 col-sm-12 float-left">
                                    <label>Total Bazar Cost <sup class="text-danger font-weight-bold">*</sup></label>
                                    <input type="number" name="total" min="1" class="form-control" placeholder="Eneter Bazar Cost" value="<?php if($_POST){
                                        echo $_POST['total'];
                                    }?>">
                                </div>
                                <div class="form-group col-md-12 col-sm-12 float-left">
                                    <label>Bazar Description</label>
                                    <textarea name="description" id="application" class="form-control"></textarea>
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
        <?php include "front/sub_footer.php";?>
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->


    <?php include "front/footer.php";?>

</body>
</html>
