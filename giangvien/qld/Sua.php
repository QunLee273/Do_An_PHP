<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        
        $sql = "SELECT * FROM qldiem WHERE id = '$id'";
        $diemList = executeResult($sql);
        
        if ($diemList != null && count($diemList) > 0) {
            $diem = $diemList[0];
            $mon = $diem["MaMon"];
            $chuyen = $diem["ChuyenCan"];
            $giua = $diem["GiuaKy"];
            $cuoi = $diem["CuoiKy"];
        }
    }
    
    if(isset($_POST["sua"])){
        $id = $_POST["id"];
        $n_mon = $_POST["mon"];
        $n_chuyen = $_POST["chuyen"];
        $n_giua = $_POST["giua"];
        $n_cuoi = $_POST["cuoi"];
        $dtb = ($n_chuyen + $n_giua*2 + $n_cuoi*7)/10;
        
        $sql = "UPDATE qldiem SET MaMon = '$n_mon', ChuyenCan = '$n_chuyen',
                                GiuaKy = '$n_giua', CuoiKy = '$n_cuoi',
                                DiemTB = '$dtb' WHERE id = '$id'";
        execute($sql);
        header("Location: qldiem.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GV - Sửa điểm</title>
</head>
<body>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <table>
        <tr>
                <td>
                    Mã môn: 
                </td>
                <td>
                    <input type="text" name="mon" value="<?php echo $mon; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Chuyên cần:
                </td>
                <td>
                    <input type="number" name="chuyen" value="<?php echo $chuyen; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Giữa kỳ:
                </td>
                <td>
                    <input type="number" name="giua" value="<?php echo $giua; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Cuối kỳ:
                </td>
                <td>
                    <input type="number" name="cuoi" value="<?php echo $cuoi; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="sua" value="Sửa">
                </td>
                <td>
                    <a style="text-decoration: none; border: 1px solid black;" href="qldiem.php">Quay lại</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>