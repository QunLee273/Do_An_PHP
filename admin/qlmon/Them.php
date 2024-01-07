<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

    $message = "";
    $n_mamon = '';
    $n_tenmon = '';
    $n_tc = '';
    $n_mgv = '';
    $n_lich = '';

    if(isset($_POST['Them'])) {
        $mamon = $_POST['mamon'];
        $tenmon = $_POST['tenmon'];
        $sotc = $_POST['sotc'];
        $magv = $_POST['magv'];
        $lich = $_POST['lich'];

        $checkSql = "SELECT * FROM monhoc WHERE MaMon = '$mamon'";
        $list = executeResult($checkSql);

        if (!empty($list)) {
            $message = '<span style="color: red;
                                    margin-top: 10px;
                                    display: block;
                                    text-align: center;
                                    ">Mã môn đã tồn tại. Vui lòng nhập mã môn khác.</span>';
            $n_mamon = '';
            $n_tenmon = $tenmon;
            $n_tc = $sotc;
            $n_mgv = $magv;
            $n_lich = $lich;
        } else {
            $checkSql = "SELECT * FROM giangvien WHERE MaGV = '$magv'";
            $list = executeResult($checkSql);
            if (empty($list)) {
                $message = '<span style="color: red;
                                    margin-top: 10px;
                                    display: block;
                                    text-align: center;
                                    ">Mã GV không tồn tại.</span>';
                $n_mamon = $mamon;
                $n_tenmon = $tenmon;
                $n_tc = $sotc;
                $n_mgv = '';
                $n_lich = $lich;
            } else {
                $sql = "INSERT INTO monhoc (MaMon, TenMon, SoTinChi, MaGV, Lich) 
                                VALUES ('$mamon', '$tenmon', '$sotc', '$magv', '$lich')";
                execute($sql);

                $n_mamon = '';
                $n_tenmon = '';
                $n_tc = '';
                $n_mgv = '';
                $n_lich = '';

                echo '<script>alert("Thêm thành công");</script>';
            }
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm môn học</title>

    <link rel="stylesheet" href="/BTL_PHP/admin/edit.css">

    <script>
        function ktForm() {
            var mamon = document.forms["myForm"]["mamon"].value.trim();
            var tenmon = document.forms["myForm"]["tenmon"].value.trim();
            var sotc = document.forms["myForm"]["sotc"].value.trim();
            var magv = document.forms["myForm"]["magv"].value.trim();
            var lich = document.forms["myForm"]["lich"].value.trim();

            var errorMessages = [];

            if (!mamon) {
                errorMessages.push("Mã môn không được để trống.");
            }

            if (!tenmon) {
                errorMessages.push("Tên môn không được để trống.");
            }

            if (!sotc) {
                errorMessages.push("Số tín chỉ không được để trống.");
            }

            if (!magv) {
                errorMessages.push("Mã GV không được để trống.");
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
    <h1>Thêm môn học</h1>
    <form name="myForm" action="" method="post" onsubmit="return ktForm()">
        <table>
            <tr>
                <td>
                    Mã môn: 
                </td>
                <td>
                    <input type="text" name="mamon" value="<?php echo $n_mamon; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Tên môn:
                </td>
                <td>
                    <input type="text" name="tenmon" value="<?php echo $n_tenmon; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Số tín chỉ:
                </td>
                <td>
                    <input type="text" name="sotc" value="<?php echo $n_tc; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Mã giảng viên:
                </td>
                <td>
                    <input type="text" name="magv" value="<?php echo $n_mgv; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Lịch:
                </td>
                <td>
                    <input type="text" name="lich" value="<?php echo $n_lich; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <a style="text-decoration: none; border: 1px solid black;" href="quanlymonhoc.php">Quay lại</a>
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