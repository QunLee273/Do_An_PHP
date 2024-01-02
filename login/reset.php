<?php
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
            $loi = "Email bạn không có trong hệ thống!!!";
        }
        else{
            $code = substr( md5( rand(0, 999999)), 0, 8);
            $sql = "UPDATE taikhoan SET Code = ? WHERE Email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute( [$code, $email] );

            $kq = Send($email, $code);
            // if ($kq==true){

            // }
        }
    }
    
    function Send($email, $code){
        require "PHPMailer-master/src/PHPMailer.php"; 
        require "PHPMailer-master/src/SMTP.php"; 
        require 'PHPMailer-master/src/Exception.php'; 
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
        try {
            $mail->SMTPDebug = 2; //0,1,2: chế độ debug
            $mail->isSMTP();  
            $mail->CharSet  = "utf-8";
            $mail->Host = 'smtp.gmail.com';  //SMTP servers
            $mail->SMTPAuth = true; // Enable authentication
            $mail->Username = 'quan.btlphp2023@gmail.com'; // SMTP username
            $mail->Password = 'P@ssw0rd_2023';   // SMTP password
            $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
            $mail->Port = 465;  // port to connect to                
            $mail->setFrom('quan.btlphp2023@gmail.com', 'Admin' ); 
            $mail->addAddress($email, 'TênNgườiNhận'); 
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = 'Code reset password';
            $noidungthu = '<p>Code của bạn là:</p>
                            <h1>' . $code . '</h1>'; 
            $mail->Body = $noidungthu;
            $mail->smtpConnect( array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            ));
            $mail->send();
            echo 'Đã gửi mail xong';
        } catch (Exception $e) {
            echo 'Error: Không gửi được', $mail->ErrorInfo;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="form login_form">
        <form action="" method="post">
            <h2>Forgot password</h2>
            <?php if ($loi!=""){ ?>
                    <div><?php echo $loi; ?></div>
            <?php } ?>
            <div class="input_box">
                <input type="text" name="email" placeholder="Nhập email của bạn" required/><br>

            </div>
            <button name="forgot" class="button">Quên</button>
        </form>
    </div>
</body>
</html>