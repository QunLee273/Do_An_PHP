
<?php
    $url = mysqli_connect('localhost', 'root', '', 'php');

    if(!$url){
        die('Không thể kết nối với database: ' . mysqli_connect_error());
    } else {
        die("Kết nối thành công");
    }
?>
