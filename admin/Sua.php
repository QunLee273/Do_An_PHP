<?php
    $con = mysqli_connect('localhost', 'user_bt', 'pass_bt', 'bt');

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        
        $sql = "SELECT * FROM loaihang WHERE MaLoai = '$id'";
        $result = mysqli_query($con, $sql);
        
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $tenLoai = $row["TenLoai"];
        }
    }
    
    if(isset($_POST["Sua"])){
        $id = $_POST["id"];
        $tenLoaiMoi = $_POST["tenhang"];
        
        $sql = "UPDATE loaihang SET TenLoai = '$tenLoaiMoi' WHERE MaLoai = '$id'";
        $result = mysqli_query($con, $sql);
        header("Location: quanlylophoc.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <table>
            <tr>
                <td>
                    Mã hàng:
                </td>
                <td>
                    <input type="text" name="id" value="<?php echo $id; ?>" readonly>
                </td>
            </tr>
            <tr>
                <td>
                    Tên hàng:
                </td>
                <td>
                    <input type="text" name="tenhang" value="<?php echo $tenLoai; ?>" >
                </td>
            </tr>
            <tr>
                <td>

                </td>
                <td>
                    <input type="submit" name="Sua" value="Sửa">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>