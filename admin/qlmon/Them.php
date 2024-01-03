<?php
    $conn = mysqli_connect('localhost', 'root', '', 'qldsv');

    $message = ""; // Initialize an empty message variable

    if(isset($_POST['Them'])) {
        $mamon = $_POST['mamon'];
        $tenmon = $_POST['tenmon'];
        $sotc = $_POST['sotc'];
        $magv = $_POST['magv'];
        $lich = $_POST['lich'];

        $checkSql = "SELECT * FROM monhoc WHERE MaMon = '$mamon'";
        $checkResult = mysqli_query($conn, $checkSql);

        if(mysqli_num_rows($checkResult) > 0) {
            $message = "Mã Môn đã tồn tại";
        } else {
            $sql = "INSERT INTO monhoc (MaMon, TenMon, SoTinChi, MaGV, Lich) VALUES ('$mamon', '$tenmon', '$sotc', '$magv', '$lich')";
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
    <title>Thêm môn học</title>
    <script>
        function showConfirmationMessage() {
            var message = "<?php echo $message; ?>";
            if (message !== "") {
                var result = confirm(message + ". Bạn có muốn thêm dữ liệu khác không?");
                if (result) {
                    window.location.href = 'Them.php';
                }else{
                    window.location.href = 'quanlymonhoc.php';
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
                    Mã môn: 
                </td>
                <td>
                    <input type="text" name="mamon">
                </td>
            </tr>
            <tr>
                <td>
                    Tên môn:
                </td>
                <td>
                    <input type="text" name="tenmon">
                </td>
            </tr>
            <tr>
                <td>
                    Số tín chỉ:
                </td>
                <td>
                    <input type="text" name="sotc">
                </td>
            </tr>
            <tr>
                <td>
                    Mã giang viên:
                </td>
                <td>
                    <input type="text" name="magv">
                </td>
            </tr>
            <tr>
                <td>
                    Lịch:
                </td>
                <td>
                    <input type="text" name="lich">
                </td>
            </tr>
            <tr>
                <td>
                    <a style="text-decoration: none; border: 1px solid black;" href="quanlymonhoc.php">Quay lại</a>
                </td>
                <td>
                    <input type="submit" name="Them" value="Thêm">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>