<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        
        $sql = "SELECT * FROM taikhoan WHERE id = '$id'";
        $tkList = executeResult($sql);
        
        if ($tkList != null && count($tkList) > 0) {
            $tk = $tkList[0];
            $hoten = $tk["HoTen"];
            $email = $tk["Email"];
            $chucvu = $tk["ChucVu"];
            $taik = $tk["TaiKhoan"];
            $mk = $tk["MatKhau"];
        }
    }
    
    if(isset($_POST["sua"])){
        $id = $_POST["id"];
        $n_hoten = $_POST["hoten"];
        $n_email = $_POST["email"];
        $n_chucvu = $_POST["chucvu"];
        $n_taik = $_POST["taikhoan"];
        $n_mk = $_POST["pass"];
        
        $sql = "UPDATE taikhoan SET HoTen = '$n_hoten', Email = '$n_email',
                                ChucVu = '$n_chucvu', TaiKhoan = '$n_taik',
                                MatKhau = '$n_mk' 
                                WHERE id = '$id'";
        execute($sql);
        header("Location: quanlynguoidung.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        // ẩn hiện mật khẩu
        function anHienPass() {
            var passwordInput = document.getElementById("pass");
            var checkbox = document.getElementById("an_hien_pass");

            if (checkbox.checked) {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</head>
<body>
    <form action="" method="post">
        <input type="number" name="id" value="<?php echo $id;?>" style="display: none;">
        <table>
        <tr>
                <td>
                    Họ tên: 
                </td>
                <td>
                    <input type="text" name="hoten" value="<?php echo $hoten; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Email:
                </td>
                <td>
                    <input type="text" name="email" value="<?php echo $email; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Chức vụ:
                </td>
                <td>
                    <input type="text" name="chucvu" value="<?php echo $chucvu; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Tài khoản:
                </td>
                <td>
                    <input type="text" name="taikhoan" value="<?php echo $taik; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Mật khẩu:
                </td>
                <td>
                    <input type="password" name="pass" id="pass" value="<?php echo $mk; ?>">
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
                    <input type="submit" name="sua" value="Sửa">
                </td>
                <td>
                    <a style="text-decoration: none; border: 1px solid black;" href="quanlynguoidung.php">Quay lại</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>