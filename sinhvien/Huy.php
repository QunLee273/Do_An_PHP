<?php
    $conn = mysqli_connect('localhost', 'root', '', 'qldsv');

    if(isset($_GET["id"])){
        $id = $_GET["id"];

        $sql = "DELETE FROM dkmon WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: sinhvien.php");
            exit;
        }
    }

    mysqli_close($conn);
?>