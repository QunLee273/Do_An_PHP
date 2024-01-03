<?php
    $con = mysqli_connect('localhost', 'root', '', 'qldsv');

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        
        $sql = "SELECT * FROM lop WHERE MaLop = '$id'";
        $result = mysqli_query($con, $sql);
        
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $tenLop = $row["TenLop"];
        }
    }
    
    if(isset($_POST["Sua"])){
        $id = $_POST["id"];
        $tenLopMoi = $_POST["tenlop"];
        
        $sql = "UPDATE lop SET TenLop = '$tenLopMoi' WHERE MaLop = '$id'";
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
    <title>Sửa lớp</title>
</head>
<body>
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
                    <input type="text" name="tenlop" value="<?php echo $tenLop; ?>" >
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="sua" value="Sửa">
                </td>
                <td>
                    <a style="text-decoration: none; border: 1px solid black;" href="quanlylophoc.php">Quay lại</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>