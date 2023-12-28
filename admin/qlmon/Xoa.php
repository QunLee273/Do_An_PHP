<?php
    $conn = mysqli_connect('localhost', 'root', '', 'qldsv');

    if(isset($_GET["id"])){
        $mamon= $_GET["id"];

        $sql = "DELETE FROM monhoc WHERE MaMon = '$mamon'";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: quanlymonhoc.php");
            exit;
        }
    }

    mysqli_close($conn);
?>