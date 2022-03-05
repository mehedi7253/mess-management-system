<?php

    session_start();
    require_once "../db/db_connect.php";

    if (isset($_GET['delete_member'])){
        $member_id = $_GET['delete_member'];

        $sql = $connect->query("DELETE FROM members WHERE id = '$member_id'");

        $_SESSION['success'] = 'Remove Successful';
        header('Location: manage-member.php');
    }

?>