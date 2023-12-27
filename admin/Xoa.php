<?php
    $conn = mysqli_connect('localhost', 'root', '', 'qldsv');

    if(isset($_GET["id"])){
        $maLop = $_GET["id"];

        $sql = "DELETE FROM lop WHERE MaLop = '$maLop'";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: quanlylophoc.php");
            exit;
        }
    }

    mysqli_close($conn);
?>