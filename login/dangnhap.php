<?php
    $mail = '';
    $pass = '';

    if(isset($_POST['login'])){
        if(isset($_POST['email']) && isset($_POST['password'])){
            $mail = $_POST['email'];
            $pass = $_POST['password'];

            if ($mail == 'admin@eaut.edu.vn' && $pass == 'admin123') {
                header("Location: /trangchu.html");
                exit();
            }
        }
    }  
?>