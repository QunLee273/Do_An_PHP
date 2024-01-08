<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    $id = $_POST['id'];

    $sql = "UPDATE taikhoan SET Code = NULL WHERE id = '$id'";
    execute($sql);
?>