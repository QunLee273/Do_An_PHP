<?php
    $conn = mysqli_connect('localhost', 'root', '', 'qldsv');

    if(isset($_GET["id"])){
        $mgv = $_GET["id"];

        $sql = "DELETE FROM giangvien WHERE MaGV = '$mgv'";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: quanlygiangvien.php");
            exit;
        }
    }

    mysqli_close($conn);
?>