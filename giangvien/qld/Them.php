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
     <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 16px;
            background-image: url("https://cdn.pixabay.com/photo/2018/08/23/07/35/thunderstorm-3625405_1280.jpg");
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        a, input[type="submit"] {
            text-decoration: none;
            display: inline-block;
            padding: 10px 20px;
            border: 1px solid #333;
            border-radius: 5px;
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        a:hover, input[type="submit"]:hover {
            background-color: #45a049;
        }

        #errorContainer {
            color: red;
            margin-top: 10px;
            display: block;
            text-align: center;
        }

        form{
            background: #ffffff66;
        }
        input[type="text"]{
            background: #ffffff00;
        }
    </style>
</head>
<body>
    <h1>Thêm Sinh viên</h1>
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