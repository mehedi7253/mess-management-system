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
                    <li class="breadcrumb-item active">Total Bazar</li>
                </ol>

                <!-- Icon Cards-->
                <div class="row">
                    <div class="col-md-10 mx-auto mb-5">
                        <div class="card">
                            <div class="card-header">
                                <h3>Total Bazar </h3>
                            </div>
                            <div class="card-body">
                                <?php
                                if (isset($_POST['search'])) {
                                    $searchKey = $_POST['src'];
                                    $sql_s = "SELECT members.id as memberID, members.name as memberName, bazars.date, bazars.total FROM members,bazars 
                                            WHERE members.id = bazars.member_id 
                                            AND MONTH(bazars.date) = '$searchKey' GROUP BY members.id;";
                                    $res_s = mysqli_query($connect, $sql_s);

                                    $rows = $res_s->num_rows;
                                }
                                ?>
                                <form action="" method="POST">
                                    <div class="form-group input-group col-md-5">
                                        <select name="src" class="form-control">
                                            <option>----------Select Month---------</option>
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                        <input type="submit" class="btn btn-info ml-2" name="search" value="Submit">
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['search']) == true) {
                                    if ($rows > 0) { ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Month</th>
                                                        <th>Total Bazar</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($res_s)) { ?>
                                                        <tr>
                                                            <td><?php echo $i++; ?></td>
                                                            <td class="text-capitalize"><?php echo $row['memberName']; ?></td>
                                                            <td><?php echo date('M', strtotime($row['date']))  ?></td>
                                                            <td>
                                                                <?php
                                                                    $total_bazar = "SELECT SUM(total) as TotalBazar FROM bazars WHERE MONTH(date) = '$searchKey' AND member_id = $row[memberID]";   
                                                                    $res_bazar   = mysqli_query($connect, $total_bazar);
                                                                    $cost_bazar = mysqli_fetch_assoc($res_bazar);    
                                                                    
                                                                    echo number_format($cost_bazar['TotalBazar'],2);
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-primary" href="bazar_person.php?userID=<?php echo $row['memberID']?>">View</a>
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-right">Total</td>
                                                        <td>
                                                            <?php
                                                                  $total_bazar = "SELECT SUM(total) as TotalBazar FROM bazars WHERE MONTH(date) = '$searchKey'";   
                                                                  $res_bazar   = mysqli_query($connect, $total_bazar);
                                                                  $cost_bazar = mysqli_fetch_assoc($res_bazar);    
                                                                  
                                                                  echo number_format($cost_bazar['TotalBazar'],2);
                                                            ?>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                <?php } else {
                                        echo 'Not found';
                                    }
                                }
                                ?>

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