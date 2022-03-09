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
                    <li class="breadcrumb-item active"> Member Report </li>
                </ol>

                <!-- Icon Cards-->
                <div class="row">
                    <div class="col-md-12 mx-auto mb-5">
                        <div class="card">
                            <div class="card-header">
                                <h3>Member Report</h3>
                            </div>
                            <div class="card-body">
                                <?php
                                    if (isset($_POST['search'])) {
                                        $searchKey = $_POST['src'];
                                        $member_id = $_POST['member_id'];
                                        $sql_s = "SELECT * FROM members, meals  
                                                WHERE members.id = meals.member_id 
                                                AND MONTH(meals.date) = '$searchKey' 
                                                AND meals.member_id = '$member_id' ORDER BY meals.date";

                                        $res_s = mysqli_query($connect, $sql_s);
                                        $rows = $res_s->num_rows;
                                    }
                                ?>
                                 <form action="" method="POST">
                                    <div class="form-group input-group col-md-4 float-left">
                                        <select name="member_id" class="form-control">
                                            <option>----------Select Member---------</option>
                                            <?php
                                                $members = "SELECT * FROM members WHERE email != 'admin@gmail.com'";
                                                $sql_members = mysqli_query($connect, $members);
                                            ?>
                                            <?php
                                            while($row = mysqli_fetch_assoc($sql_members)){?>
                                                <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group input-group col-md-4">
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
                                                            <th>Date</th>
                                                            <th>Day</th>
                                                            <th>Night</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 1;
                                                        while ($row = mysqli_fetch_assoc($res_s)) { ?>
                                                            <tr>
                                                                <td><?php echo $i++; ?></td>
                                                                <td class="text-capitalize"><?php echo $row['name']; ?></td>
                                                                <td><?php echo date('M', strtotime($row['date']))  ?></td>
                                                                <td><?php echo date('d', strtotime($row['date']))  ?></td>
                                                                <td><?php echo $row['day_meal'];?> </td>
                                                                <td><?php echo $row['night_meal'];?> </td>
                                                                <td><?php echo $row['day_meal'] + $row['night_meal'];?> </td>
                                                            </tr>
                                                        <?php }
                                                        ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="text-right">Total</td>
                                                            <td>
                                                                <?php
                                                                    $total_meal = "SELECT SUM(day_meal + night_meal) as MyMeal FROM meals WHERE MONTH(date) = '$searchKey' AND member_id = '$member_id'";   
                                                                    $res_meal   = mysqli_query($connect, $total_meal);
                                                                    $my_meal        = mysqli_fetch_assoc($res_meal);    
                                                                    
                                                                    echo $my_meal['MyMeal'];
                                                                ?>
                                                            </td>
                                                           
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <hr/>
                                                <h5>Bazar Cost List</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Date</th>
                                                                <th>Bazar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $bazar = "SELECT * FROM bazars WHERE member_id = '$member_id' AND MONTH(date) = '$searchKey'";
                                                                $res_bzar = mysqli_query($connect, $bazar);
                                                                $i =1;
                                                                while($data = mysqli_fetch_assoc($res_bzar)){?>
                                                                    <tr>
                                                                        <td><?php echo $i++;?></td>
                                                                        <td><?php echo date('m/d/Y', strtotime($data['date'])) ?></td>
                                                                        <td><?php echo number_format($data['total'],2)?></td>
                                                                    </tr>
                                                                <?php }
                                                            ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td></td>
                                                                <td class="text-right">Total</td>
                                                                <td>
                                                                    <?php
                                                                        $bazar = "SELECT SUM(total) as MyBazar FROM bazars WHERE member_id = '$member_id' AND MONTH(date) = '$searchKey'";
                                                                        $result = mysqli_query($connect, $bazar);
                                                                        $my_bazar = mysqli_fetch_assoc($result);
                                                                        echo number_format($my_bazar['MyBazar'],2);
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>

                                                <hr/>
                                                <h3>Meal Rate </h3>
                                                <div class="table-responsive col-md-5 float-left">
                                                    <table class="table table-bordered ">
                                                        <?php
                                                            $totalMeal = "SELECT SUM(day_meal + night_meal) AS TotalMeal FROM meals WHERE MONTH(date) = '$searchKey'";
                                                            $res_meal  = mysqli_query($connect, $totalMeal);
                                                            $meal  = mysqli_fetch_assoc($res_meal);
                    
                                                            $month_bazar = "SELECT SUM(total) as TotalBazar FROM bazars WHERE MONTH(date) = '$searchKey'";
                                                            $res_bazar   = mysqli_query($connect, $month_bazar);
                                                            $totalBazar  = mysqli_fetch_assoc($res_bazar);
                                                            $mealRate = $totalBazar['TotalBazar'] /  $meal['TotalMeal'];

                                                        ?>
                                                        <tr>
                                                            <th>Total Meal</th>
                                                            <td><?php echo $meal['TotalMeal'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Total Bazar</th>
                                                            <td><?php echo number_format($totalBazar['TotalBazar'],2);?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Meal Rate</th>
                                                            <td><?php echo $mealRate?> </td>
                                                        </tr>
                                                    </table>
                                                    
                                                </div>
                                                

                                                <div class="table-responsive col-md-5 float-left">
                                                    <table class="table table-bordered ">
                                                        
                                                        <tr>
                                                            <th>My Meal</th>
                                                            <td><?php echo $my_meal['MyMeal'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>My Bazar</th>
                                                            <td><?php echo number_format($my_bazar['MyBazar'],2);?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>My Meal Rate</th>
                                                            <td><?php echo $total = $my_meal['MyMeal'] * $mealRate;?> </td>
                                                        </tr>
                                                        <tr>
                                                            <th>DESC(+/-)</th>
                                                            <td>
                                                                <?php
                                                                    $final = $total - $my_bazar['MyBazar'];
                                                                    echo number_format($final, 2);
                                                                ?>
                                                            </td>
                                                        </tr>
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