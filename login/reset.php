<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    $loi = "";

    if ( isset($_POST['forgot'])){
        $email = $_POST['email'];

        $conn = new PDO("mysql:host=localhost;dbname=qldsv;charset=utf8", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



        $sql = "SELECT * FROM taikhoan WHERE Email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute( [$email] );
        $count = $stmt->rowCount();

        if ($count==0){
            $loi = '<span style="color: red;
                                margin-top: 10px;
                                display: block;
                                text-align: center;
                                ">Mail không tồn tại.</span>';
        }
        else{
            $code = substr( md5( rand(0, 999999)), 0, 8);
            $sql = "UPDATE taikhoan SET Code = ? WHERE Email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute( [$code, $email] );

            $kq = Send($email, $code);

            if ($kq) {
                $loi = '<span style="color: green;
                                margin-top: 10px;
                                display: block;
                                text-align: center;
                                ">Gửi thành công.<br>Vui lòng kiểm tra email của bạn.</span>';

                $sql = "SELECT * FROM taikhoan WHERE Code = '$code'";
                $list = executeResult($sql);
        
                if ($list != NULL && count($list) > 0) {
                    $tk = $list[0];
                    $id = $tk['id'];
                }
                echo '<script>
                        setTimeout(function() {
                            var xhr = new XMLHttpRequest();
                            xhr.open("POST", "xoaCode.php", true);
                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                            xhr.send("id=' . $id . '");
                        }, 60000);
                        </script>';
            } else {
                $loi = '<span style="color: red;
                                margin-top: 10px;
                                display: block;
                                text-align: center;
                                ">Mail chưa được gửi.</span>';
            }
        }
    }
    
    function Send($email, $code){
        require "PHPMailer-master/src/PHPMailer.php"; 
        require "PHPMailer-master/src/SMTP.php"; 
        require 'PHPMailer-master/src/Exception.php'; 
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
        try {
            $mail->SMTPDebug = 0; //0,1,2: chế độ debug
            $mail->isSMTP();  
            $mail->CharSet  = "utf-8";
            $mail->Host = 'smtp.gmail.com';  //SMTP servers
            $mail->SMTPAuth = true; // Enable authentication
            $mail->Username = 'quan.btlphp2023@gmail.com'; // SMTP username
            $mail->Password = 'jmlh xdri qwyv xeyz';   // SMTP password
            $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
            $mail->Port = 465;  // port to connect to                
            $mail->setFrom('quan.btlphp2023@gmail.com', 'Trường QNT' ); 
            $mail->addAddress($email, 'TênNgườiNhận'); 
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = 'Reset password';
            $noidungthu = '<h1><a href="http://localhost/BTL_PHP/login/chanePass.php?code=' . $code . '">Đặt lại mật khẩu</a></h1>'; 
            $mail->Body = $noidungthu;
            $mail->smtpConnect( array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            ));
            $mail->send();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>

    <style>
        body {
            background-color: #Dbe2e4;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        

        input[type="email"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            height: 30px;
        }

        button {
            display: inline-block;
            text-decoration: none;
            border: 1px solid #333;
            padding: 6px 12px;
            border-radius: 3px;
            color: #333;
            margin-right: 10px;
            margin-top: 10px;
            background-color: #37934b;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        button:hover {
            background-color: #333;
            color: #fff;
        }

        .error {
            color: red;
            font-size: 14px;
            display: block;
            margin-top: 10px;
            text-align: center;
        }
    </style>

    <script>
        
    </script>
</head>
<body>
    <div>
        <form action="" method="post" >
            <div id="sendCode">
                <h1>Forgot password</h1>
                <?php if ($loi!=""){ ?>
                        <div><?php echo $loi; ?></div>
                <?php } ?>
                
                <div>
                    <label for="email">Nhập email:</label>
                    <input type="email" name="email" placeholder="Nhập email của bạn" required/><br>
                </div>
                <a style="text-decoration: none; border: 1px solid black;" href="/BTL_PHP/login/index.php">Quay lại</a>
                <button name="forgot" class="button">Gửi</button>
            </div>
        </form>
    </div>
</body>
</html>