<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    $message = "";

    if(isset($_POST['Them'])) {
        if (!empty($_POST['malop']) || !empty($_POST['tenlop'])) {
            $malop = $_POST['malop'];
            $tenlop = $_POST['tenlop'];

            $checkSql = "SELECT * FROM lop WHERE MaLop = '$malop' OR TenLop = '$tenlop'";
            $list = executeResult($checkSql);

            if (!empty($list)) {
                $message = '<span style="color: red;
                                        margin-top: 10px;
                                        display: block;
                                        text-align: center;
                                        ">Mã lớp hoặc tên lớp đã tồn tại.</span>';
            } else {
                $sql = "INSERT INTO lop (MaLop, TenLop) VALUES ('$malop', '$tenlop')";
                execute($sql);

                echo '<script>alert("Thêm thành công");</script>';
            }
        } else {
            $message = '<span style="color: red;
                                        margin-top: 10px;
                                        display: block;
                                        text-align: center;
                                        ">Vui lòng nhập đầy đủ thông tin.</span>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm lớp</title>

    <link rel="stylesheet" href="/BTL_PHP/admin/edit.css">

</head>
<body>
        <h1>Thêm lớp</h1>
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
        <div><?php echo $message; ?></div>
    </form>
</body>
</html>