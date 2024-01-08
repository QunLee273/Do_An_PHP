<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    $mess = "";

    if (isset($_GET["code"])) {
        $code = $_GET["code"];

        $sql = "SELECT * FROM taikhoan WHERE Code = '$code'";
        $list = executeResult($sql);

        if ($list != NULL && count($list) > 0) {
            $tk = $list[0];
            $id = $tk['id'];
        } else {
            echo '<script>alert("Không thể truy cập vì đã quá thời hạn."); window.location.href = "/BTL_PHP/login/index.php";</script>';
            exit;
        }

        echo '<script>
            setTimeout(function() {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "xoaCode.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("id=' . $id . '");
            }, 60000);
            </script>';
    }

    if (isset($_POST["chane"])) {
        $mk = $_POST['pass'];
        $c_mk = $_POST['C_pass'];

        $sql = "SELECT * FROM taikhoan WHERE Code = '$code'";
        $list = executeResult($sql);

        if ($list != NULL && count($list) > 0) {
            $tk = $list[0];
            $code = $tk['Code'];
        }

        if ($code != NULL) {
            $sql1 = "UPDATE taikhoan SET Code = NULL WHERE id = '$id'";
            execute($sql1);

            if ($mk != $c_mk) {
                $mess = '<span style="color: red;
                        margin-top: 10px;
                        display: block;
                        text-align: center;
                        ">Mật khẩu không khớp.</span>';
            } else {
                $sql = "UPDATE taikhoan SET MatKhau = '$mk' WHERE Code = '$code'";
                execute($sql);

                $sql1 = "UPDATE taikhoan SET Code = NULL WHERE id = '$id'";
                execute($sql1);

                echo '<script>alert("Thay đổi mật khẩu thành công"); window.location.href = "/BTL_PHP/login/index.php";</script>';
                exit;
            }
        } else {
            echo '<script>alert("Không thể thay đổi vì đã quá thời hạn."); window.location.href = "/BTL_PHP/login/reset.php";</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu</title>

    <link rel="stylesheet" href="/BTL_PHP/admin/edit.css">

    <script>
        function ktForm() {
            var mk = document.forms["myForm"]["pass"].value.trim();
            var c_mk = document.forms["myForm"]["C_pass"].value.trim();

            var errorMessages = [];

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
    <form name="myForm" action="" method="post" onsubmit="return ktForm()">
        <h1>Đổi mật khẩu</h1>
        <table>
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
                    <a style="text-decoration: none; border: 1px solid black;" href="/BTL_PHP/login/reset.php">Quay lại</a>
                </td>
                <td>
                    <input type="submit" name="chane" value="Thay đổi">
                </td>
            </tr>
        </table>
        <div id="errorContainer"><?php echo $mess; ?></div>
    </form>
</body>
</html>
