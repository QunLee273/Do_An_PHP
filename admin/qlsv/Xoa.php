<?php
    $conn = mysqli_connect('localhost', 'root', '', 'qldsv');

    if(isset($_GET["id"])){
        $msv = $_GET["id"];

        $sql = "DELETE FROM sinhvien WHERE MSV = '$msv'";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: quanlysinhvien.php");
            exit;
        }
    }

    mysqli_close($conn);
?>