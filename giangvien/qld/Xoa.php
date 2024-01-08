<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    if(isset($_GET["id"])){
        $id = $_GET["id"];

        $sql = "DELETE FROM qldiem WHERE id = '$id'";
        execute($sql);

        echo '<script>alert("Xóa thành công"); window.location.href = "qldiem.php";</script>';
        exit;
    }
?>