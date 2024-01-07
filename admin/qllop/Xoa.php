<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    if(isset($_GET["id"])){
        $maLop = $_GET["id"];

        $sql = "DELETE FROM lop WHERE MaLop = '$maLop'";
        execute($sql);

        echo '<script>alert("Xóa thành công"); window.location.href = "quanlylophoc.php";</script>';
        exit;
    }
?>