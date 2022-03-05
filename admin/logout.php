<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 11/17/2020
 * Time: 2:42 PM
 */

    session_start();
    unset($_SESSION['admin_email']);
    session_destroy();
    header('location: ../index.php');

?>