<?php
    $conn = mysqli_connect('localhost', 'root', '', 'qldsv');

    $message = ""; // Initialize an empty message variable

    if(isset($_POST['Them'])) {
        $malop = $_POST['malop'];
        $tenlop = $_POST['tenlop'];

        $checkSql = "SELECT * FROM lop WHERE MaLop = '$malop'";
        $checkResult = mysqli_query($conn, $checkSql);

        if(mysqli_num_rows($checkResult) > 0) {
            $message = "Mã lớp đã tồn tại";
        } else {
            $sql = "INSERT INTO lop (MaLop, TenLop) VALUES ('$malop', '$tenlop')";
            $result = mysqli_query($conn, $sql);
        }
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
    <title>Thêm lớp</title>
    <script>
        function showConfirmationMessage() {
            var message = "<?php echo $message; ?>";
            if (message !== "") {
                var result = confirm(message + ". Bạn có muốn thêm dữ liệu khác không?");
                if (result) {
                    window.location.href = 'Them.php';
                }else{
                    window.location.href = 'quanlylophoc.php';
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
                    Mã lớp: 
                </td>
                <td>
                    <input type="text" name="malop">
                </td>
            </tr>
            <tr>
                <td>
                    Tên lớp:
                </td>
                <td>
                    <input type="text" name="tenlop">
                </td>
            </tr>
            <tr>
                <td>
                    <a style="text-decoration: none; border: 1px solid black;" href="quanlylophoc.php">Quay lại</a>
                </td>
                <td>
                    <input type="submit" name="Them" value="Thêm">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>