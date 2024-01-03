<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    $message = "";

    if(isset($_POST['Them'])) {
        $mgv = $_POST['mgv'];
        $hoten = $_POST['hoten'];
        $date = $_POST['date'];
        $gt = $_POST['gt'];
        $email = $_POST['email'];
        $diachi = $_POST['diachi'];

        $sql = "INSERT INTO giangvien (MaGV, HoTen, NgaySinh, GioiTinh, Email, DiaChi) 
                VALUES ('$mgv', '$hoten', '$date', '$gt', '$email', '$diachi')";
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
    <title>Thêm giảng viên</title>
    <script>
        function showConfirmationMessage() {
            var message = "<?php echo $message; ?>";
            if (message !== "") {
                var result = confirm(message + ". Bạn có muốn thêm dữ liệu khác không?");
                if (result) {
                    window.location.href = 'Them.php';
                }else{
                    window.location.href = 'quanlygiangvien.php';
                }
            }
        }
    </script>
</head>
<body onload="showConfirmationMessage()">
    <form action="" method="post">
        <table>
            <tr>
                <td>
                    Mã GV: 
                </td>
                <td>
                    <input type="number" name="mgv">
                </td>
            </tr>
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
                    Ngày sinh(yyyy-mm-dd):
                </td>
                <td>
                    <input type="date" name="date">
                </td>
            </tr>
            <tr>
                <td>
                    Giới tính:
                </td>
                <td>
                    <input type="text" name="gt">
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
                    Địa chỉ:
                </td>
                <td>
                    <input type="text" name="diachi">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="Them" value="Thêm">
                </td>
                <td>
                    <a style="text-decoration: none; border: 1px solid black;" href="quanlygiangvien.php">Quay lại</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>