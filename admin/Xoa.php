<?php
    $con = mysqli_connect('localhost', 'user_bt', 'pass_bt', 'bt');

    if(isset($_GET["id"])){
        $maLoai = $_GET["id"];

        $sql = "DELETE FROM loaihang WHERE MaLoai = '$maLoai'";
        $result = mysqli_query($con, $sql);

        if($result){
            header("Location: quanlylophoc.php");
            exit;
        }
    }

    mysqli_close($con);
?>