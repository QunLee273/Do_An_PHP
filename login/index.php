<?php
    session_start();

    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    $cookie_name = 'remember_me';
    $cookie_time = (3600 * 24 * 30); // 30 days

    if (isset($_COOKIE['remember_me'])) {
        // Lấy thông tin đăng nhập từ cookie
        $remember_data = $_COOKIE['remember_me'];
        list($username, $password) = explode(':', $remember_data);
    } else {
        $username = '';
        $password = '';
    }


    if(isset($_POST['login'])){
        if(isset($_POST['user']) && isset($_POST['password'])){
            $user = $_POST['user'];
            $pass = $_POST['password'];

            $sql = "SELECT * FROM taikhoan WHERE TaiKhoan = '$user'";
            $dnList = executeResult($sql);

            if ($dnList != null && count($dnList) > 0) {
                $dn = $dnList[0];
                if ($user == $dn["TaiKhoan"] && $pass == $dn["MatKhau"]){
                    $email = $dn["Email"];
                    $_SESSION["email"] = $email;

                    if (isset($_POST['remember'])) {
                        // Lưu tên người dùng và mật khẩu vào cookie
                        $remember_data = $user . ':' . $pass;
                        setcookie('remember_me', $remember_data, time() + $cookie_time);
                    } else {
                        // Xóa cookie nếu không chọn Remember Me
                        setcookie('remember_me', '', time() - 1);
                    }

                    if ($dn["ChucVu"] == "Quản trị viên"){
                        header("Location: /BTL_PHP/admin/admin.html");
                        exit;
                    }elseif ($dn["ChucVu"] == "Giảng viên") {
                        header("Location: /BTL_PHP/giangvien/giangvien.php");
                        exit;
                    }else{
                        header("Location: /BTL_PHP/sinhvien/sinhvien.php");
                        exit;
                    }
                }
            } else {
                echo '<script>alert("Sai tài khoản hoặc mật khẩu");</script>';
            }
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản lý điểm hệ đại học</title>
    <link rel="stylesheet" href="style.css">
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.8/css/line.css"
    />
  </head>
  <body>
    <!-- header -->
    <header class="header" id="header">
       <nav class="nav">
        <a href="#" class="nav_logo">
           Đại học QNT 
        </a>
        <ul class="nav_items">
           <li class="nav_items">
            <a href="#" class="nav_link">Home</a>
            <a href="/BTL_PHP/blog/blog.html" class="nav_link">BLog</a>
            <a href="#footer" class="nav_link">Contact</a>
           </li>
        </ul>
        <button class="button" id="form-open">
            Login
        </button>
        </nav>
    </header>   
    <!-- Home  -->
    <section class="home">
        <div class="form_container">
            <i class="uil uil-times form_close"></i>
                <!-- loginform -->
                <div class="form login_form">
                    <form action="" method="post">
                        <h2>Login</h2>
                        <div class="input_box">
                            <input type="text" name="user" placeholder="Nhập username của bạn" value="<?php echo $username ?>" required/>
                            <i class="uil uil-envelope-alt email"></i>
                        </div>
                        <div class="input_box">
                            <input type="password" name="password" placeholder="Nhập password của bạn" value="<?php echo $password ?>" required/>
                            <i class="uil uil-lock password"></i>
                        </div>
                        <div class="optine_field">
                            <span class="checkbox">
                                <input type="checkbox" name="remember" <?php if (isset($_COOKIE['remember_me'])) { echo 'checked'; } ?> id="check">
                                <label for="check">Remember me </label>
                            </span>
                            <a href="reset.php" class="forgot_pw" name="forgot">Forgot password</a>
                        </div>
                        <button name="login" class="button">Login now</button>
                    </form>
                </div>
        </div>
    </section>
    <footer id="footer">
        <div class="footer nav_logo">
            Đại học QNT
        </div>
        <div class="footer_creator">
            <table border="0">
                <tr>
                    <td><p>Created by: </p></td>
                    <td><p> Lê Minh Quân</p></td>
                </tr>
                <tr>
                    <td></td>
                    <td><p> Vũ Hoài Nam</p></td>
                </tr>
                <tr>
                    <td></td>
                    <td><p> Bùi Văn Tuấn</p></td>
                </tr>
            </table>
            <p>2023 &copy; All rights reserved</p>
        </div>
        <div class="footer_contact">
            <table border="0">
                <tr>
                    <td><p>Contact: </p></td>
                    <td><p> 20212504@eaut.edu.vn</p></td>
                </tr>
                <tr>
                    <td></td>
                    <td><p> 20212501@eaut.edu.vn</p></td>
                </tr>
                <tr>
                    <td></td>
                    <td><p> 20212612@eaut.edu.vn</p></td>
                </tr>
            </table>
            <p>Phone: 123-456-7890</p>
        </div>
    </footer>
    <script src="dangnhap.js"></script>
  </body>
</html>
