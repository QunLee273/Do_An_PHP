<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    $message = '';

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

        $sql1 = "SELECT * FROM monhoc WHERE MaMon = '$n_mon'";
        $list1 = executeResult($sql1);

        if (!empty($list1)) {
            if (!is_numeric($n_chuyen) || !is_numeric($n_giua) || !is_numeric($n_cuoi)) {
                $message = '<span style="color: red;
                                        margin-top: 10px;
                                        display: block;
                                        text-align: center;
                                        ">Vui lòng nhập giá trị số cho Chuyên cần, Giữa kỳ và Cuối kỳ.</span>';
            } else {
                if ($n_chuyen >= 0 && $n_chuyen <= 10 && $n_giua >= 0 && $n_giua <= 10 && $n_cuoi >= 0 && $n_cuoi <= 10) {
                    $sql = "UPDATE qldiem SET MaMon = '$n_mon', ChuyenCan = '$n_chuyen',
                                            GiuaKy = '$n_giua', CuoiKy = '$n_cuoi',
                                            DiemTB = '$dtb' WHERE id = '$id'";
                    execute($sql);
                    echo '<script>alert("Cập nhật thành công"); window.location.href = "qldiem.php";</script>';
                    exit;
                } else {
                    $message = '<span style="color: red;
                                        margin-top: 10px;
                                        display: block;
                                        text-align: center;
                                        ">Điểm không được lớn hơn 10 hoặc nhỏ hơn 0.</span>';
                }
            }
        } else {
            $message = '<span style="color: red;
                                    margin-top: 10px;
                                    display: block;
                                    text-align: center;
                                    ">Mã môn không tồn tại.</span>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GV - Sửa điểm</title>

    <link rel="stylesheet" href="/BTL_PHP/admin/edit.css">
    
    <script>
        function ktForm() {
            var mamon = document.forms["myForm"]["mon"].value.trim();

            var errorMessages = [];

            if (!mamon) {
                errorMessages.push("Mã môn không được để trống.");
            }

            if (errorMessages.length > 0) {
                var errorContainer = document.getElementById("errorContainer");
                errorContainer.innerHTML = "";
                for (var i = 0; i < errorMessages.length; i++) {
                    var errorElement = document.createElement("p");
                    errorElement.className = "error";
                    errorElement.textContent = errorMessages[i];
                    errorContainer.appendChild(errorElement);
                }
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <h1>Sửa điểm</h1>
    <form name="myForm" action="" method="post" onsubmit="return ktForm()">
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
                    <input type="text" name="chuyen" value="<?php echo $chuyen; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Giữa kỳ:
                </td>
                <td>
                    <input type="text" name="giua" value="<?php echo $giua; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Cuối kỳ:
                </td>
                <td>
                    <input type="text" name="cuoi" value="<?php echo $cuoi; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <a style="text-decoration: none; border: 1px solid black;" href="qldiem.php">Quay lại</a>
                </td>
                <td>
                    <input type="submit" name="sua" value="Sửa">
                </td>
            </tr>
        </table>
        <div id="errorContainer"><?php echo $message; ?></div>
    </form>
</body>
</html>