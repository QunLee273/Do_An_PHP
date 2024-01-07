<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    $message = '';

    if(isset($_GET["id"])){
        $msv = $_GET["id"];
        
        $sql = "SELECT *, DATE_FORMAT(NgaySinh, '%Y-%m-%d') AS NgaySinh FROM sinhvien WHERE MSV = '$msv'";
        
        $svList = executeResult($sql);
        
        if ($svList != null && count($svList) > 0) {
            $sv = $svList[0];
            $hoten = $sv['HoTen'];
            $date = $sv['NgaySinh'];
            $gt = $sv['GioiTinh'];
            $lop = $sv['MaLop'];
            $email = $sv['Email'];
            $diachi = $sv['DiaChi'];
        }
    }
    
    if(isset($_POST["Sua"])){
        $msv = $_POST["id"];
        $n_hoten = $_POST['hoten'];
        $n_date = $_POST['date'];
        $n_gt = $_POST['gt'];
        $n_lop = $_POST['lop'];
        $n_email = $_POST['email'];
        $n_diachi = $_POST['diachi'];
        
        if (!empty($msv) && !empty($n_hoten) && !empty($n_date) && !empty($n_gt) && !empty($n_lop) && !empty($n_email) && !empty($n_diachi)) {
            $checkSql2 = "SELECT * FROM lop WHERE MaLop = '$n_lop'";
            $list = executeResult($checkSql2);

            if (empty($list)) {
                $message = '<span style="color: red;
                                        margin-top: 10px;
                                        display: block;
                                        text-align: center;
                                        ">Mã lớp không tồn tại.</span>';
            } else {
                $sql = "UPDATE sinhvien SET HoTen = '$n_hoten', NgaySinh = STR_TO_DATE('$n_date', '%Y-%m-%d'), 
                        GioiTinh = '$n_gt', MaLop = '$n_lop', Email = '$n_email', DiaChi = '$n_diachi' 
                        WHERE MSV = '$msv'";
                execute($sql);
                echo '<script>alert("Sửa thành công"); window.location.href = "quanlysinhvien.php";</script>';
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
    <title>Sửa sinh viên</title>

    <link rel="stylesheet" href="/BTL_PHP/admin/edit.css">

</head>
<body>
    <h1>Sửa sinh viên </h1>
    <form action="" method="post">
        <table>
            <tr>
                <td>
                    MSV:
                </td>
                <td>
                    <input type="text" name="id" value="<?php echo $msv; ?>" readonly>
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
                    Mã lớp:
                </td>
                <td>
                    <input type="text" name="lop" value="<?php echo $lop; ?>" >
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
                    <a style="text-decoration: none; border: 1px solid black;" href="quanlysinhvien.php">Quay lại</a>
                </td>
            </tr>
        </table>
        <div><?php echo $message; ?></div>
    </form>
</body>
</html>