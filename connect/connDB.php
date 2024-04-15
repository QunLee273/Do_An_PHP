<?php
    require_once('config.php');

// Sử dụng cho các câu lệnh insert, update, delete
    function execute($sql){
        // Tạo kết nối
        $conn = mysqli_connect(host, username, pass, db);
        
        // sql
        mysqli_query($conn, $sql);

        // Đóng kết nối
        mysqli_close($conn);
    }

// Sử dụng cho lệnh select
    function executeResult($sql){
        // Tạo kết nối
        $conn = mysqli_connect(host, username, pass, db);
        
        // sql
        $resultset = mysqli_query($conn, $sql);
        $list = [];

        while ($row = mysqli_fetch_array($resultset, 1)) {
            $list[] = $row;
        }

        // Đóng kết nối
        mysqli_close($conn);

        return $list;
    }
?>
