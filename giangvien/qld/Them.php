<?php
    session_start();
    $email = $_SESSION['email'];

    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    $sql = "SELECT * FROM giangvien WHERE Email LIKE '%$email%'";

    $gvList = executeResult($sql);

    if ($gvList != null && count($gvList) > 0) {
        $gv = $gvList[0];
        $magv = $gv['MaGV'];
    }

    $message = "";

    if(isset($_POST['Them'])) {
        $msv = $_POST['msv'];
        $mamon = $_POST['mamon'];

        $sql = "INSERT INTO qldiem (MSV, MaMon, ChuyenCan, GiuaKy, CuoiKy, DiemTB, MaGV) VALUES ('$msv', '$mamon', '', '', '', '', '$magv')";
        $result = execute($sql);

        if($result) {
            $message = "Thêm dữ liệu thành công";
        } else {
            $message = "Thêm dữ liệu thất bại";
        }
    }
?>
<?php
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GV - Thêm điểm</title>
    <script>
        function showConfirmationMessage() {
            var message = "<?php echo $message; ?>";
            if (message !== "") {
                var result = confirm(message + ". Bạn có muốn thêm dữ liệu khác không?");
                if (result) {
                    window.location.href = 'Them.php';
                }else{
                    window.location.href = 'qldiem.php';
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
                    Mã môn dạy:
                </td>
                <td>
                    <input type="text" name="mamon">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="Them" value="Thêm">
                </td>
                <td>
                    <a style="text-decoration: none; border: 1px solid black;" href="qldiem.php">Quay lại</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>