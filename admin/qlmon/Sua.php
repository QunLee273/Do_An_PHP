<?php
    $con = mysqli_connect('localhost', 'root', '', 'qldsv');

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        
        $sql = "SELECT * FROM monhoc WHERE MaMon = '$id'";
        $result = mysqli_query($con, $sql);
        
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $tenmon = $row["TenMon"];
            $sotc = $row["SoTinChi"];
            $magv = $row["MaGV"];
            $lich = $row["Lich"];
        }
    }
    
    if(isset($_POST["Sua"])){
        $id = $_POST["id"];
        $n_tenmon = $_POST["tenmon"];
        $n_sotc = $_POST["sotc"];
        $n_magv = $_POST["magv"];
        $n_lich = $_POST["lich"];
        
        $sql = "UPDATE monhoc SET TenMon = '$n_tenmon', SoTinChi = '$n_sotc', MaGV = '$n_magv', Lich = '$n_lich' WHERE MaMon = '$id'";
        $result = mysqli_query($con, $sql);
        header("Location: quanlymonhoc.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa môn học</title>
</head>
<body>
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
    </form>
</body>
</html>