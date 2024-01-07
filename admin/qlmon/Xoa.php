<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    if(isset($_GET["id"])){
        $mamon= $_GET["id"];

        $sql = "DELETE FROM monhoc WHERE MaMon = '$mamon'";
        execute($sql);

        echo '<script>alert("Xóa thành công"); window.location.href = "quanlymonhoc.php";</script>';
        exit;
    }
?>