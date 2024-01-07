<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    $message = "";
    $n_hoten = '';
    $n_date = '';
    $n_gt = '';
    $n_email = '';
    $n_diachi = '';

    if(isset($_POST['Them'])) {
        $mgv = $_POST['mgv'];
        $hoten = $_POST['hoten'];
        $date = $_POST['date'];
        $gt = $_POST['gt'];
        $email = $_POST['email'];
        $diachi = $_POST['diachi'];

        // Kiểm tra trùng khóa chính
        $checkSql = "SELECT * FROM giangvien WHERE MaGV = '$mgv'";
        $list = executeResult($checkSql);

        if (!empty($list)) {
            $message = '<span style="color: red;
                                    margin-top: 10px;
                                    display: block;
                                    text-align: center;
                                    ">Mã GV đã tồn tại. Vui lòng chọn một mã GV khác.</span>';
            $mgv = '';
            $n_hoten = $hoten;
            $n_date = $date;
            $n_gt = $gt;
            $n_email = $email;
            $n_diachi = $diachi;
        } else {
            $sql = "INSERT INTO giangvien (MaGV, HoTen, NgaySinh, GioiTinh, Email, DiaChi) 
                            VALUES ('$mgv', '$hoten', '$date', '$gt', '$email', '$diachi')";
            execute($sql);

            $mgv = '';
            $n_hoten = '';
            $n_date = '';
            $n_gt = '';
            $n_email = '';
            $n_diachi = '';

            echo '<script>alert("Thêm thành công");</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm giảng viên</title>

    <link rel="stylesheet" href="/BTL_PHP/admin/edit.css">

    <script>
        function ktForm() {
            var mgv = document.forms["myForm"]["mgv"].value.trim();
            var hoten = document.forms["myForm"]["hoten"].value.trim();
            var date = document.forms["myForm"]["date"].value.trim();
            var gt = document.forms["myForm"]["gt"].value.trim();
            var email = document.forms["myForm"]["email"].value.trim();
            var diachi = document.forms["myForm"]["diachi"].value.trim();

            var errorMessages = [];

            if (mgv === "") {
                errorMessages.push("Mã GV không được để trống.");
            }

            if (!hoten) {
                errorMessages.push("Họ tên không được để trống.");
            }

            if (!date) {
                errorMessages.push("Ngày sinh không được để trống.");
            }

            if (!gt) {
                errorMessages.push("Giới tính không được để trống.");
            }

            if (!email) {
                errorMessages.push("Email không được để trống.");
            } else if (!validateEmail(email)) {
                errorMessages.push("Email không hợp lệ.");
            }

            if (!diachi) {
                errorMessages.push("Địa chỉ không được để trống.");
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
    </script>
</head>
<body>
        <h1>Thêm giảng viên </h1>
    <form name="myForm" action="" method="post" onsubmit="return ktForm()">
        <table>
            <tr>
                <td>
                    Mã GV: 
                </td>
                <td>
                    <input type="number" name="mgv" value="<?php echo $mgv; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Họ tên: 
                </td>
                <td>
                    <input type="text" name="hoten" value="<?php echo $n_hoten; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Ngày sinh:
                </td>
                <td>
                    <input type="date" name="date" value="<?php echo $n_date; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Giới tính:
                </td>
                <td>
                    <input type="text" name="gt" value="<?php echo $n_gt; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Email:
                </td>
                <td>
                    <input type="email" name="email" value="<?php echo $n_email; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Địa chỉ:
                </td>
                <td>
                    <input type="text" name="diachi" value="<?php echo $n_diachi; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <a style="text-decoration: none; border: 1px solid black;" href="quanlygiangvien.php">Quay lại</a>
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