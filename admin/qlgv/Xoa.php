<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    if(isset($_GET["id"])){
        $mgv = $_GET["id"];

        $sql = "DELETE FROM giangvien WHERE MaGV = '$mgv'";
        execute($sql);

        echo '<script>alert("Xóa thành công"); window.location.href = "quanlygiangvien.php";</script>';
        exit;
    }
?>