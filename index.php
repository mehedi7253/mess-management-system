<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 1/11/2021
 * Time: 10:19 AM
 */
    session_start();
    include "db/db_connect.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mess Management System</title>
    <link rel="stylesheet" href="assets/style/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/style/main.css" type="text/css">
    <link rel="icon" href="images/falcon1.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<style>
    .login{
        background-image: url('images/loginbg.jpg');
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }
</style>
<body class="login">

    <section class="login" style="margin-top: 10%;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto mt-5 mb-5">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h3 class="text-center">User Login</h3>
                        </div>
                        <div class="card-body">
                            <?php
                             global  $connect;
                            if (isset($_POST['user_login'])){
                                $email    = $_POST['email'];
                                $password = $_POST['password'];
                                $has = hash('md5', $password);

                                if ($email == ''){
                                    $_SESSION['ema'] = 'Please Enter Email Address';
                                }elseif ($password == ''){
                                    $_SESSION['pass'] = 'Please Enter Password';
                                }else{
                                    $sql = "SELECT * FROM members WHERE email ='$email' AND password = '$has'";

                                    $result = mysqli_query($connect, $sql);

                                    if (mysqli_num_rows($result) > 0){
                                        $data = mysqli_fetch_assoc($result);
                                        $_SESSION['admin_email'] = $data['email'];
                                        echo "<script>document.location.href='admin/index.php'</script>";
                                    }else{
                                        $_SESSION['error'] = 'User Name or Password is Incorrect';
                                    }
                                }
                            }
                            if(isset($_SESSION['ema'])){
                                echo "
                                        <div class='alert alert-danger alert-dismissible' id='ema' style='background-color: red; color: white'>
                                            <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['ema']."
                                        </div>
                                    ";
                                unset($_SESSION['ema']);
                            }
                            if(isset($_SESSION['pass'])){
                                echo "
                                        <div class='alert alert-danger alert-dismissible' id='pass' style='background-color: red; color: white'>
                                            <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['pass']."
                                        </div>
                                        ";
                                unset($_SESSION['pass']);
                            }
                            if(isset($_SESSION['error'])){
                                echo "
                                        <div class='alert alert-danger alert-dismissible' id='error' style='background-color: red; color: white' role='alert'>   
                                            <span><i class='fas fa-exclamation-triangle'></i></span> ".$_SESSION['error']."
                                        </div>
                                        ";
                                unset($_SESSION['error']);
                            }
                            ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email" name="email" value="<?php if($_POST) {
                                        echo $_POST['email'];
                                    } ?>">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" placeholder="Enter Password" name="password"/>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="submit" name="user_login"  value="Login" class="btn btn-success col-4"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

<!--script-->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script>
     $(function() {
        setTimeout(function() { $("#success").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#ema").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#pass").fadeOut(1500); }, 3000)
    })
    $(function() {
        setTimeout(function() { $("#error").fadeOut(1500); }, 3000)
    })
</script>
<!--end script-->
</body>
</html>
