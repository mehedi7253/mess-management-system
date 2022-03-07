<?php

    session_start();
    require_once "../db/db_connect.php";

    if (isset($_GET['delete_member'])){
        $member_id = $_GET['delete_member'];

        $sql = $connect->query("DELETE FROM members WHERE id = '$member_id'");

        $_SESSION['success'] = 'Remove Successful';
        header('Location: manage-member.php');
    }

    if (isset($_GET['dor_id'])) {
        $dor_id = $_GET['dor_id'];

        $sql = $connect->query("DELETE FROM weakly_bazars WHERE id = '$dor_id'");

        $_SESSION['success'] = 'Remove Successful';
        header('Location: manage-bazar-dor.php');
    }


?>