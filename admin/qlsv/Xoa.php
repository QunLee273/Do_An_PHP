<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    if(isset($_GET["id"])){
        $msv = $_GET["id"];

        $sql = "DELETE FROM sinhvien WHERE MSV = '$msv'";
        execute($sql);

        echo '<script>alert("Xóa thành công"); window.location.href = "quanlysinhvien.php";</script>';
        exit;
    }
?>