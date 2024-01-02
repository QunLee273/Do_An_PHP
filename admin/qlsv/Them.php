<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    $message = "";

    if(isset($_POST['Them'])) {
        $msv = $_POST['msv'];
        $hoten = $_POST['hoten'];
        $date = $_POST['date'];
        $gt = $_POST['gt'];
        $lop = $_POST['lop'];
        $email = $_POST['email'];
        $diachi = $_POST['diachi'];

        $sql = "INSERT INTO sinhvien (MSV, HoTen, NgaySinh, GioiTinh, MaLop, Email, DiaChi) 
                VALUES ('$msv', '$hoten', '$date', '$gt', '$lop', '$email', '$diachi')";
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
                    window.location.href = 'quanlysinhvien.php';
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
                    MSV: 
                </td>
                <td>
                    <input type="text" name="msv">
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
                    Mã lớp:
                </td>
                <td>
                    <input type="text" name="lop">
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
                    <a style="text-decoration: none; border: 1px solid black;" href="quanlysinhvien.php">Quay lại</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>