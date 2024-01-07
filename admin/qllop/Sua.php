<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    $message = '';

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        
        $sql = "SELECT * FROM lop WHERE MaLop = '$id'";
        $list = executeResult($sql);
        
        if($list != null && count($list) > 0){
            $lop = $list[0];
            $tenlop = $lop['TenLop'];
        }
    }
    
    if(isset($_POST["sua"])){
        if (!empty($_POST["id"]) && !empty($_POST['tenlop'])) {
            $malop = $_POST["id"];
            $n_tenlop = $_POST['tenlop'];
            $sql = "SELECT * FROM lop WHERE TenLop = '$n_tenlop'";
            $list = executeResult($sql);
            if (!empty($list)) {
                $message = '<span style="color: red;
                                        margin-top: 10px;
                                        display: block;
                                        text-align: center;
                                        ">Tên lớp đã tồn tại.</span>';
            } else {
                $sql = "UPDATE lop SET TenLop = '$n_tenlop' WHERE MaLop = '$malop'";
                execute($sql);

                echo '<script>alert("Sửa thành công"); window.location.href = "quanlylophoc.php";</script>';
                exit;
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
    <title>Sửa lớp</title>

    <link rel="stylesheet" href="/BTL_PHP/admin/edit.css">

</head>
<body>
    <h1>Sửa lớp</h1>
    <form action="" method="post">
        <table>
            <tr>
                <td>
                    Mã lớp:
                </td>
                <td>
                    <input type="text" name="id" value="<?php echo $id; ?>" readonly>
                </td>
            </tr>
            <tr>
                <td>
                    Tên lớp:
                </td>
                <td>
                    <input type="text" name="tenlop" value="<?php echo $tenlop; ?>" >
                </td>
            </tr>
            <tr>
                <td>
                    <a style="text-decoration: none; border: 1px solid black;" href="quanlylophoc.php">Quay lại</a>
                </td>
                <td>
                    <input type="submit" name="sua" value="Sửa">
                </td>
            </tr>
        </table>
        <div><?php echo $message; ?></div>
    </form>
</body>
</html>