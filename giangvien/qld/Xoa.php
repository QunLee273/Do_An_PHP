<?php
    $conn = mysqli_connect('localhost', 'root', '', 'qldsv');

    if(isset($_GET["id"])){
        $id = $_GET["id"];

        $sql = "DELETE FROM qldiem WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: qldiem.php");
            exit;
        }
    }

    mysqli_close($conn);
?>