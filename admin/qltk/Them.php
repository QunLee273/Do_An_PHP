<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    $message = "";
    $n_hoten = "";
    $n_email = "";
    $n_chucvu = "";
    $n_tk = "";
    $n_pass = "";
    $n_c_pass = "";

    if(isset($_POST['Them'])) {
        $hoten = $_POST['hoten'];
        $email = $_POST['email'];
        $chucvu = isset($_POST['chucvu']) ? $_POST['chucvu'] : '';
        $tk = $_POST['taikhoan'];
        $pass = $_POST['pass'];
        $c_pass = $_POST['C_pass'];

        if (!empty($hoten) && !empty($email) && !empty($chucvu) && !empty($tk) && !empty($pass) && !empty($c_pass)) {
            $sql = "SELECT * FROM taikhoan WHERE TaiKhoan = '$tk'";
            $list = executeResult($sql);
            
            if (empty($list)) {
                if ($chucvu == "Quản trị viên") {
                    $sql1 = "INSERT INTO taikhoan (HoTen, Email, ChucVu, TaiKhoan, MatKhau, Code) VALUES ('$hoten', '$email', '$chucvu', '$tk', '$pass', '')";
                            execute($sql1);
    
                            $n_hoten = "";
                            $n_email = "";
                            $n_chucvu = "";
                            $n_tk = "";
                            $n_pass = "";
                            $n_c_pass = "";
    
                            echo '<script>alert("Thêm thành công");</script>';
                } elseif ($chucvu == "Giảng viên") {
                    $sql = "SELECT * FROM giangvien WHERE Email = '$email'";
                    $list = executeResult($sql);
    
                    if (!empty($list)) {
                        if ($pass != $c_pass) {
                            $message = '<span style="color: red;
                                            margin-top: 10px;
                                            display: block;
                                            text-align: center;
                                            ">Mật khẩu không khớp.</span>';
                        
                            $n_hoten = $hoten;
                            $n_email = $email;
                            $n_chucvu = $chucvu;
                            $n_tk = $tk;
                            $n_pass = $pass;
                            $n_c_pass = '';
    
                        } else {
                            $sql1 = "INSERT INTO taikhoan (HoTen, Email, ChucVu, TaiKhoan, MatKhau, Code) VALUES ('$hoten', '$email', '$chucvu', '$tk', '$pass', '')";
                            execute($sql1);
    
                            $n_hoten = "";
                            $n_email = "";
                            $n_chucvu = "";
                            $n_tk = "";
                            $n_pass = "";
                            $n_c_pass = "";
    
                            echo '<script>alert("Thêm thành công");</script>';
                        }
                    } else {
                            $message = '<span style="color: red;
                                                margin-top: 10px;
                                                display: block;
                                                text-align: center;
                                                ">Email không tồn tại.</span>';
        
                            $n_hoten = $hoten;
                            $n_email = '';
                            $n_chucvu = $chucvu;
                            $n_tk = $tk;
                            $n_pass = $pass;
                            $n_c_pass = $c_pass;
                    }          
                } else {
                    $sql = "SELECT * FROM sinhvien WHERE Email = '$email'";
                    $list = executeResult($sql);
    
                    if (!empty($list)) {
                        if ($pass != $c_pass) {
                            $message = '<span style="color: red;
                                            margin-top: 10px;
                                            display: block;
                                            text-align: center;
                                            ">Mật khẩu không khớp.</span>';
                        
                            $n_hoten = $hoten;
                            $n_email = $email;
                            $n_chucvu = $chucvu;
                            $n_tk = $tk;
                            $n_pass = $pass;
                            $n_c_pass = '';
    
                        } else {
                            $sql = "INSERT INTO taikhoan (HoTen, Email, ChucVu, TaiKhoan, MatKhau, Code) VALUES ('$hoten', '$email', '$chucvu', '$tk', '$pass', '')";
                            execute($sql);
    
                            $n_hoten = "";
                            $n_email = "";
                            $n_chucvu = "";
                            $n_tk = "";
                            $n_pass = "";
                            $n_c_pass = "";
    
                            echo '<script>alert("Thêm thành công");</script>';
                        }
                    } else {
                            $message = '<span style="color: red;
                                                margin-top: 10px;
                                                display: block;
                                                text-align: center;
                                                ">Email không tồn tại.</span>';
        
                            $n_hoten = $hoten;
                            $n_email = '';
                            $n_chucvu = $chucvu;
                            $n_tk = $tk;
                            $n_pass = $pass;
                            $n_c_pass = $c_pass;
                    }
                }
            } else {
                $message = '<span style="color: red;
                                            margin-top: 10px;
                                            display: block;
                                            text-align: center;
                                            ">Tài khoản đã tồn tại.</span>';
                        
                $n_hoten = $hoten;
                $n_email = $email;
                $n_chucvu = $chucvu;
                $n_tk = '';
                $n_pass = $pass;
                $n_c_pass = $c_pass;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm người dùng</title>

    <link rel="stylesheet" href="/BTL_PHP/admin/edit.css">

    <script>
        function ktForm() {
            var hoten = document.forms["myForm"]["hoten"].value.trim();
            var email = document.forms["myForm"]["email"].value.trim();
            var chucvu = document.forms["myForm"]["chucvu"].value.trim();
            var tk = document.forms["myForm"]["taikhoan"].value.trim();
            var mk = document.forms["myForm"]["pass"].value.trim();
            var c_mk = document.forms["myForm"]["C_pass"].value.trim();

            var errorMessages = [];

            if (!hoten) {
                errorMessages.push("Họ tên không được để trống.");
            }

            if (!email) {
                errorMessages.push("Email không được để trống.");
            } else if (!validateEmail(email)) {
                errorMessages.push("Email không hợp lệ.");
            }

            if (!chucvu) {
                errorMessages.push("Chức vụ chưa được chọn.");
            }

            if (!tk) {
                errorMessages.push("Tài khoản không được để trống.");
            }

            if (!mk) {
                errorMessages.push("Mật khẩu không được để trống.");
            }

            if (!c_mk) {
                errorMessages.push("Xác nhận mật khẩu không được để trống.");
            }

            if (errorMessages.length > 0) {
                var errorContainer = document.getElementById("errorContainer");
                errorContainer.innerHTML = "";
                for (var i = 0; i < errorMessages.length; i++) {
                    var errorElement = document.createElement("p");
                    errorElement.className = "error";
                    errorElement.textContent = errorMessages[i];
                    errorContainer.appendChild(errorElement);
                }
                return false;
            }

            return true;
        }

        function ktEmail(email) {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }

        // ẩn hiện mật khẩu
        function anHienPass() {
            var passwordInput = document.getElementById("pass");
            var confirmPasswordInput = document.getElementById("C_pass");
            var checkbox = document.getElementById("an_hien_pass");

            if (checkbox.checked) {
                passwordInput.type = "text";
                confirmPasswordInput.type = "text";
            } else {
                passwordInput.type = "password";
                confirmPasswordInput.type = "password";
            }
        }
    </script>
</head>
<body>
    <h1>Thêm tài khoản</h1>
    <form name="myForm" action="" method="post" onsubmit="return ktForm()">
        <table>
            <tr>
                <td>
                    Tên hiển thị: 
                </td>
                <td>
                    <input type="text" name="hoten" value="<?php echo $n_hoten; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Email:
                </td>
                <td>
                    <input type="text" name="email" value="<?php echo $n_email; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Chức vụ:
                </td>
                <td>
                    <select name="chucvu" class="op_chucvu">
                        <option value="" disabled <?php if(empty($n_chucvu)) echo 'selected'; ?>>Chọn chức vụ</option>
                        <option value="Quản trị viên" <?php if($n_chucvu == 'Quản trị viên') echo 'selected'; ?>>Admin</option>
                        <option value="Giảng viên" <?php if($n_chucvu == 'Giảng viên') echo 'selected'; ?>>Giảng viên</option>
                        <option value="Sinh viên" <?php if($n_chucvu == 'Sinh viên') echo 'selected'; ?>>Sinh viên</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Tài khoản:
                </td>
                <td>
                    <input type="text" name="taikhoan" value="<?php echo $n_tk; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Mật khẩu:
                </td>
                <td>
                    <input type="password" name="pass" id="pass" value="<?php echo $n_pass; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Xác nhận mật khẩu:
                </td>
                <td>
                    <input type="password" name="C_pass" id="C_pass" value="<?php echo $n_c_pass; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    
                </td>
                <td>
                <input type="checkbox" name="an_hien_pass" id="an_hien_pass" onclick="anHienPass()">Hiện mật khẩu
                </td>
            </tr>
            <tr>
                <td>
                    <a style="text-decoration: none; border: 1px solid black;" href="quanlynguoidung.php">Quay lại</a>
                </td>
                <td>
                    <input type="submit" name="Them" value="Thêm">
                </td>
            </tr>
        </table>
        <div id="errorContainer"><?php echo $message; ?></div>
    </form>
</body>
</html>