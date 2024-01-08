<?php
    session_start();
    $email = $_SESSION['email'];

    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    $sql = "SELECT * FROM giangvien WHERE Email LIKE '%$email%'";
    $gvList = executeResult($sql);

    if ($gvList != null && count($gvList) > 0) {
        $gv = $gvList[0];
        $magv = $gv['MaGV'];
    }

    $message = "";

    if(isset($_POST['Them'])) {
        $msv = $_POST['msv'];
        $mamon = $_POST['mamon'];
        
        $sql2 = "SELECT * FROM sinhvien WHERE MSV = '$msv'";
        $list2 = executeResult($sql2);

        if (!empty($list2)) {
            $sql3 = "SELECT * FROM monhoc WHERE MaMon = '$mamon'";
            $list3 = executeResult($sql3);

            if (!empty($list3)) {
                $sql = "INSERT INTO qldiem (MSV, MaMon, ChuyenCan, GiuaKy, CuoiKy, DiemTB, MaGV) VALUES ('$msv', '$mamon', '', '', '', '', '$magv')";
                $result = execute($sql);

                echo '<script>alert("Thêm thành công");</script>';
            } else {
                $message = '<span style="color: red;
                                    margin-top: 10px;
                                    display: block;
                                    text-align: center;
                                    ">Mã môn không tồn tại.</span>';
            }
        } else {
            $message = '<span style="color: red;
                                    margin-top: 10px;
                                    display: block;
                                    text-align: center;
                                    ">Mã SV không tồn tại.</span>';
        }
    }
?>
<?php
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GV - Thêm điểm</title>

    <link rel="stylesheet" href="/BTL_PHP/admin/edit.css">

    <script>
        function ktForm() {
            var mgv = document.forms["myForm"]["msv"].value.trim();
            var mamon = document.forms["myForm"]["mamon"].value.trim();

            var errorMessages = [];

            if (!msv) {
                errorMessages.push("Mã SV không được để trống.");
            }

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
    <h1>Thêm</h1>
    <form name="myForm" action="" method="post" onsubmit="return ktForm()">
        <table>
            <tr>
                <td>
                    MSV: 
                </td>
                <td>
                    <input type="text" name="msv">
                </td>
            </tr>
            <tr>
                <td>
                    Mã môn dạy:
                </td>
                <td>
                    <input type="text" name="mamon">
                </td>
            </tr>
            <tr>
                <td>
                    <a style="text-decoration: none; border: 1px solid black;" href="qldiem.php">Quay lại</a>
                </td>
                <td>
                    <input type="submit" name="Them" value="Thêm">
                </td>
            </tr>
        </table>
        <div id="errorContainer"><?php echo $message; ?></div>
    </form>
</body>
</html>