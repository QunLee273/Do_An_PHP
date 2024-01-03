<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    if(isset($_GET["id"])){
        $mgv = $_GET["id"];
        
        $sql = "SELECT *, DATE_FORMAT(NgaySinh, '%Y-%m-%d') AS NgaySinh FROM giangvien WHERE MaGV = '$mgv'";
        
        $gvList = executeResult($sql);
        
        if ($gvList != null && count($gvList) > 0) {
            $gv = $gvList[0];
            $hoten = $gv['HoTen'];
            $date = $gv['NgaySinh'];
            $gt = $gv['GioiTinh'];
            $email = $gv['Email'];
            $diachi = $gv['DiaChi'];
        }
    }
    
    if(isset($_POST["Sua"])){
        $mgv = $_POST["id"];
        $n_hoten = $_POST['hoten'];
        $n_date = $_POST['date'];
        $n_gt = $_POST['gt'];
        $n_email = $_POST['email'];
        $n_diachi = $_POST['diachi'];
        
        $sql = "UPDATE giangvien SET HoTen = '$n_hoten', NgaySinh = STR_TO_DATE('$n_date', '%Y-%m-%d'), 
                        GioiTinh = '$n_gt', Email = '$n_email', DiaChi = '$n_diachi' 
                WHERE MaGV = '$mgv'";
        execute($sql);
        header("Location: quanlygiangvien.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa giảng viên</title>
</head>
<body>
    <form action="" method="post">
        <table>
            <tr>
                <td>
                    Mã GV:
                </td>
                <td>
                    <input type="text" name="id" value="<?php echo $mgv; ?>" readonly>
                </td>
            </tr>
            <tr>
                <td>
                    Họ tên:
                </td>
                <td>
                    <input type="text" name="hoten" value="<?php echo $hoten; ?>" >
                </td>
            </tr>
            <tr>
                <td>
                    Ngày sinh:
                </td>
                <td>
                    <input type="date" name="date" value="<?php echo date('Y-m-d', strtotime($date)); ?>" >
                </td>
            </tr>
            <tr>
                <td>
                    Giới tính:
                </td>
                <td>
                    <input type="text" name="gt" value="<?php echo $gt; ?>" >
                </td>
            </tr>
            <tr>
                <td>
                    Email:
                </td>
                <td>
                    <input type="text" name="email" value="<?php echo $email; ?>" >
                </td>
            </tr>
            <tr>
                <td>
                    Địa chỉ:
                </td>
                <td>
                    <input type="text" name="diachi" value="<?php echo $diachi; ?>" >
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="Sua" value="Sửa">
                </td>
                <td>
                    <a style="text-decoration: none; border: 1px solid black;" href="quanlygiangvien.php">Quay lại</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>