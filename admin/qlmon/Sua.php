<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        
        $sql = "SELECT * FROM monhoc WHERE MaMon = '$id'";
        $list = executeResult($sql);
        
        if($list != null && count($list) > 0){
            $mon = $list[0];
            $tenmon = $mon["TenMon"];
            $sotc = $mon["SoTinChi"];
            $magv = $mon["MaGV"];
            $lich = $mon["Lich"];
        }
    }
    
    if(isset($_POST["Sua"])){
        $id = $_POST["id"];
        $n_tenmon = $_POST["tenmon"];
        $n_sotc = $_POST["sotc"];
        $n_magv = $_POST["magv"];
        $n_lich = $_POST["lich"];
        
        if (!empty($n_tenmon) && !empty($n_sotc) && !empty($n_magv)) {
            $checkSql = "SELECT * FROM giangvien WHERE MaGV = '$n_magv'";
            $list = executeResult($checkSql);

            if (empty($list)) {
                $message = '<span style="color: red;
                                    margin-top: 10px;
                                    display: block;
                                    text-align: center;
                                    ">Mã GV không tồn tại.</span>';
            } else {
                $sql = "UPDATE monhoc SET TenMon = '$n_tenmon', SoTinChi = '$n_sotc', MaGV = '$n_magv', Lich = '$n_lich' 
                    WHERE MaMon = '$id'";
                execute($sql);

                echo '<script>alert("Sửa thành công"); window.location.href = "quanlymonhoc.php";</script>';
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
    <title>Sửa môn học</title>

    <link rel="stylesheet" href="/BTL_PHP/admin/edit.css">

</head>
<body>
    <h1>Sửa môn học</h1>
    <form action="" method="post">
        
        <table>
            <tr>
                <td>
                    Mã môn:
                </td>
                <td>
                    <input type="text" name="id" value="<?php echo $id; ?>" readonly>
                </td>
            </tr>
            <tr>
                <td>
                    Tên môn:
                </td>
                <td>
                    <input type="text" name="tenmon" value="<?php echo $tenmon; ?>" >
                </td>
            </tr>
            <tr>
                <td>
                    Số tín chỉ:
                </td>
                <td>
                    <input type="number" name="sotc" value="<?php echo $sotc; ?>" >
                </td>
            </tr>
            <tr>
                <td>
                    Mã giảng viên:
                </td>
                <td>
                    <input type="number" name="magv" value="<?php echo $magv; ?>" >
                </td>
            </tr>
            <tr>
                <td>
                    Lịch:
                </td>
                <td>
                    <input type="text" name="lich" value="<?php echo $lich; ?>" >
                </td>
            </tr>
            <tr>
                <td>
                    <a style="text-decoration: none; border: 1px solid black;" href="quanlymonhoc.php">Quay lại</a>
                </td>
                <td>
                    <input type="submit" name="Sua" value="Sửa">
                </td>
            </tr>
        </table>
        <div><?php echo $message; ?></div>
    </form>
</body>
</html>