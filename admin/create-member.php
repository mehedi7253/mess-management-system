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
                <li class="breadcrumb-item active">Add New Member</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add New Member <a href="manage-member.php" class="btn btn-primary float-right">Manage Member</a> </h3>
                        </div>
                        <div class="card-body">
                
                            <?php
                                if (isset($_POST['btn']))
                                {
                                    $name        = $_POST['name'];
                                    $email       = $_POST['email'];
                                    $has         = hash('md5', 123);

                                    if($name == ''){
                                       echo "<span class='text-danger'>Please Enter Name</span>";
                                    }elseif($email == '')
                                    {
                                        echo "<span class='text-danger'>Please Enter Email</span>";
                                    }else{
                                        $sql = "INSERT INTO members (name,email,password) values ('$name', '$email','$has')";
                                        $res = mysqli_query($connect, $sql);

                                        if ($res)
                                        {
                                            $_SESSION['success'] = 'Added Successful';
                                            echo "<script>document.location.href='manage-member.php'</script>";
                                        }else{
                                            echo "<span class='text-danger'>Failed Try Again..!</span>";
                                        }
                                    }
                                }
                            ?>
                            <form action="" method="POST">
                                <div class="form-group col-md-6 col-sm-12 float-left">
                                    <label>Name <sup class="text-danger font-weight-bold">*</sup></label>
                                    <input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php if($_POST) {
                                        echo $_POST['name'];
                                    } ?>">
                                </div>
                                <div class="form-group col-md-6 col-sm-12 float-left">
                                    <label>Email <sup class="text-danger font-weight-bold">*</sup></label>
                                    <input type="email" name="email" placeholder="Enter Email" class="form-control" value="<?php if($_POST) {
                                        echo $_POST['email'];
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
        <?php include "front/sub_footer.php";?>
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->


    <?php include "front/footer.php";?>

</body>
</html>
