<?php
  session_start();
  $email = $_SESSION['email'];

  require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

  $sql = "SELECT * FROM taikhoan WHERE Email LIKE '%$email%'";

  $tenList = executeResult($sql);

  if ($tenList != null && count($tenList) > 0) {
    $ten = $tenList[0];
    $hoten = $ten['HoTen'];
  }

  $sql2 = "SELECT * FROM sinhvien WHERE Email LIKE '%$email%'";

  $svList = executeResult($sql2);

  if ($svList != null && count($svList) > 0) {
    $sv = $svList[0];
    $msv = $sv['MSV'];
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btndkmon"])) {
    $dangky = $_POST["dangky"]; // Lấy giá trị của các checkbox được chọn

    // Kiểm tra danh sách checkbox không rỗng
    if (!empty($dangky)) {
        // Duyệt qua danh sách checkbox được chọn và thực hiện lưu vào cơ sở dữ liệu
        foreach ($dangky as $maMon) {
            
            $sql3 = "INSERT INTO dkmon (MSV, MaMon) VALUES ('$msv', '$maMon')";
            execute($sql3);

            header("Location: sinhvien.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title> Sinh viên </title>
    <link rel="stylesheet" href="sinhvien.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <div class="container">
        <form action="" method="post">
            <div class="topic">Sinh Viên QNT</div>
                <label class="topic">
                    <p><?php echo $hoten; ?> - <a style="font-size: 24px; color: white;" href="/BTL_PHP/login/index.php">Đăng xuất</a></p>
                </label>
            <div class="content">
                <input type="radio" name="slider" style="display: none;" checked id="diem">
                <input type="radio" name="slider" style="display: none;" id="lich">
                <input type="radio" name="slider" style="display: none;" id="dkmon">
                
                <div class="list">
                    <label for="diem" class="diem">
                        <i class="fas fa-home"></i>
                        <span class="title">Xem Bảng Điểm</span>
                    </label>
                    <label for="lich" class="lich">
                        <span class="icon"><i class="fas fa-blog"></i></span>
                        <span class="title">Xem Lịch Học</span>
                    </label>
                    <label for="dkmon" class="dkmon">
                        <span class="icon"><i class="far fa-envelope"></i></span>
                        <span class="title">Đăng Ký Môn</span>
                    </label>
                    
                    <div class="slider"></div>
                </div>
                <div class="text-content">
                    <table>
                        <tr>
                            <td class="diem text">
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Môn Học</th>
                                            <th>Chuyên cần</th>
                                            <th>Giữa kỳ</th>
                                            <th>Cuối kỳ</th>
                                            <th>TB</th>
                                            <th>Giảng viên</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

                                            // Lấy dữ liệu từ cơ sở dữ liệu
                                            $sql = "SELECT * FROM qldiem 
                                                    JOIN giangvien ON qldiem.MaGV = giangvien.MaGV
                                                    JOIN monhoc ON qldiem.MaMon = monhoc.MaMon
                                                    WHERE MSV LIKE '%$msv%'";
                                            $diemList = executeResult($sql);

                                            $stt = 1;
                                    
                                            if (!empty($diemList)) {
                                                foreach ($diemList as $diem) {
                                                    echo "<tr>
                                                        <td>" . $stt . "</td>
                                                        <td>" . $diem['TenMon'] . "</td>
                                                        <td>" . $diem['ChuyenCan'] . "</td>
                                                        <td>" . $diem['GiuaKy'] . "</td>
                                                        <td>" . $diem['CuoiKy'] . "</td>
                                                        <td>" . $diem['DiemTB']. "</td>
                                                        <td>" . $diem['HoTen'] . "</td>
                                                        </tr>";

                                                        $stt++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='7'>Không có dữ liệu</td></tr>";
                                            }

                                        ?>      
                                    </tbody>
                                </table>
                            </td>
                            <td class="lich text">
                                <table border=1>
                                    <thead>
                                        <tr>
                                            <td><b>STT</b></td>
                                            <td><b>Môn</b></td>
                                            <td><b>Thời gian</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

                                            $sql = "SELECT * FROM qldiem 
                                                    JOIN monhoc ON qldiem.MaMon = monhoc.MaMon
                                                    WHERE MSV LIKE '%$msv%'";
                                            $tgList = executeResult($sql);

                                            $stt = 1;
                                    
                                            if (!empty($tgList)) {
                                                foreach ($tgList as $tg) {
                                                    echo "<tr>
                                                        <td>" . $stt . "</td>
                                                        <td>" . $tg['TenMon'] . "</td>
                                                        <td>" . $tg['Lich'] . "</td>
                                                        </tr>";

                                                        $stt++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='3'>Không có dữ liệu</td></tr>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </td>
                            <td class="dkmon text">
                                <div>
                                    <?php
                                        // Lấy danh sách môn học
                                        $monhocList = executeResult("SELECT * FROM monhoc");

                                        // Kiểm tra danh sách môn học không rỗng
                                        if (!empty($monhocList)) {
                                            // Kiểm tra sinh viên đã đăng ký môn học chưa
                                            $daDangKyList = executeResult("SELECT MaMon FROM dkmon WHERE MSV = $msv");

                                            // Tạo mảng chứa mã môn đã đăng ký
                                            $daDangKyMon = [];
                                            foreach ($daDangKyList as $daDangKy) {
                                                $daDangKyMon[] = $daDangKy['MaMon'];
                                            }

                                            // Kiểm tra nếu sinh viên đã đăng ký tất cả các môn học
                                            $dangKyHet = count($daDangKyMon) == count($monhocList);

                                            if (!$dangKyHet) {
                                                echo '<h2>Đăng ký Môn</h2>';
                                                echo '<table>';
                                                echo '<tr><th>STT</th><th>Mã Môn</th><th>Tên Môn</th><th>Đăng ký</th></tr>';

                                                $stt = 1;

                                                // Duyệt qua danh sách môn học
                                                foreach ($monhocList as $monhoc) {
                                                    $maMon = $monhoc['MaMon'];
                                                    $tenMon = $monhoc['TenMon'];

                                                    // Kiểm tra nếu môn học chưa được đăng ký
                                                    if (!in_array($maMon, $daDangKyMon)) {
                                                        echo '<tr>';
                                                        echo '<td>' . $stt . '</td>';
                                                        echo '<td>' . $maMon . '</td>';
                                                        echo '<td>' . $tenMon . '</td>';
                                                        echo '<td><input type="checkbox" name="dangky[]" value="' . $maMon . '"></td>';
                                                        echo '</tr>';

                                                        $stt++;
                                                    }
                                                }

                                                echo '</table>';
                                                echo '<div><input type="submit" name="btndkmon" value="Đăng ký"></div>';
                                            } else {
                                                echo '<p>Bạn đã đăng ký tất cả các môn học.</p>';
                                            }
                                        } else {
                                            echo '<p>Không có môn học nào để đăng ký.</p>';
                                        }
                                    ?>
                                </div>
                                <div>
                                    <br><h2>Môn đang đăng ký</h2>
                                    <table border=1>
                                        <thead>
                                            <tr>
                                                <td><b>STT</b></td>
                                                <td><b>Môn</b></td>
                                                <td><b>Lịch</b></td>
                                                <td><b>Tín chỉ</b></td>
                                                <td><b>Giảng viên</b></td>
                                                <td><b></b></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql4 = "SELECT * FROM monhoc 
                                                        JOIN dkmon ON monhoc.MaMon = dkmon.MaMon
                                                        JOIN  giangvien ON monhoc.MaGV = giangvien.MaGV
                                                        WHERE dkmon.MSV LIKE '%$msv%'";
                                                $hkList = executeResult($sql4);

                                                $stt = 1;
                                        
                                                if (!empty($hkList)) {
                                                    foreach ($hkList as $dk) {
                                                        echo "<tr>
                                                            <td>" . $stt . "</td>
                                                            <td>" . $dk['TenMon'] . "</td>
                                                            <td>" . $dk['Lich'] . "</td>
                                                            <td>" . $dk['SoTinChi'] . "</td>
                                                            <td>" . $dk['HoTen'] . "</td>
                                                            <td><a href='Huy.php?id=" . $dk["id"] . "' onclick='return confirm(\"Bạn có chắc chắn muốn hủy?\")'>Hủy</a></td>
                                                            </tr>";

                                                            $stt++;
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='6'>Không có dữ liệu</td></tr>";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        
                        </tr>
                    </table>
                </div>
            </div>
        </form>
    </div>

</body>
</html>
