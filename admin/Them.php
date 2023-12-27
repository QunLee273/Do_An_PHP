<?php
    $con = mysqli_connect('localhost', 'user_bt', 'pass_bt', 'bt');

    $message = ""; // Initialize an empty message variable

    if(isset($_POST['Them'])) {
        $maloai = $_POST['maloai'];
        $tenhang = $_POST['tenhang'];

        $checkSql = "SELECT * FROM loaihang WHERE MaLoai = '$maloai'";
        $checkResult = mysqli_query($con, $checkSql);

        if(mysqli_num_rows($checkResult) > 0) {
            $message = "Mã loại đã tồn tại";
        } else {
            $sql = "INSERT INTO loaihang (MaLoai, TenLoai) VALUES ('$maloai', '$tenhang')";
            $result = mysqli_query($con, $sql);
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
    <title>Document</title>
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
                    Mã loại: 
                </td>
                <td>
                    <input type="text" name="maloai">
                </td>
            </tr>
            <tr>
                <td>
                    Tên hàng:
                </td>
                <td>
                    <input type="text" name="tenhang">
                </td>
            </tr>
            <tr>
                <td>

                </td>
                <td>
                    <input type="submit" name="Them" value="Thêm">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>