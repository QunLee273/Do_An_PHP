<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    $message = "";

    if(isset($_POST['Them'])) {
        $hoten = $_POST['hoten'];
        $email = $_POST['email'];
        $chucvu = $_POST['chucvu'];
        $tk = $_POST['taikhoan'];
        $pass = $_POST['pass'];

        $sql = "INSERT INTO taikhoan (HoTen, Email, ChucVu, TaiKhoan, MatKhau) VALUES ('$hoten', '$email', '$chucvu', '$tk', '$pass')";
        $result = execute($sql);

        if($result) {
            $message = "Thêm dữ liệu thành công";
        } else {
            $message = "Thêm dữ liệu thất bại";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function showConfirmationMessage() {
            var message = "<?php echo $message; ?>";
            if (message !== "") {
                var result = confirm(message + ". Bạn có muốn thêm dữ liệu khác không?");
                if (result) {
                    window.location.href = 'Them.php';
                }else{
                    window.location.href = 'quanlynguoidung.php';
                }
            }
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
<body onload="showConfirmationMessage()">
    <form action="" method="post">
        <table>
            <tr>
                <td>
                    Họ tên: 
                </td>
                <td>
                    <input type="text" name="hoten">
                </td>
            </tr>
            <tr>
                <td>
                    Email:
                </td>
                <td>
                    <input type="text" name="email">
                </td>
            </tr>
            <tr>
                <td>
                    Chức vụ:
                </td>
                <td>
                    <input type="text" name="chucvu">
                </td>
            </tr>
            <tr>
                <td>
                    Tài khoản:
                </td>
                <td>
                    <input type="text" name="taikhoan">
                </td>
            </tr>
            <tr>
                <td>
                    Mật khẩu:
                </td>
                <td>
                    <input type="password" name="pass" id="pass">
                </td>
            </tr>
            <tr>
                <td>
                    Xác nhận mật khẩu:
                </td>
                <td>
                    <input type="password" name="C_pass" id="C_pass">
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
                    <input type="submit" name="Them" value="Thêm">
                </td>
                <td>
                    <a style="text-decoration: none; border: 1px solid black;" href="quanlynguoidung.php">Quay lại</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>