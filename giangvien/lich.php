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

$sql2 = "SELECT * FROM giangvien WHERE Email LIKE '%$email%'";

$gvList = executeResult($sql2);

if ($gvList != null && count($gvList) > 0) {
  $gv = $gvList[0];
  $mgv = $gv['MaGV'];
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Giảng viên - lịch</title>
  <link rel="stylesheet" href="/BTL_PHP/giangvien/lich.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
  <div class="main_box">
    <input type="checkbox" name="check" id="check" checked>
    <div class="btn_one">
      <label for="check">
        <i class="fas fa-bars"></i>
      </label>
    </div>
    <div class="sidebar_menu">
      <div class="logo">
        <a href="/BTL_PHP/giangvien/giangvien.php">Giảng Viên QNT </a>
      </div>
      <div class="btn_two">
        <label for="check">
          <i class="fas fa-times"></i>
        </label>
      </div>
      <div class="menu">
        <ul>
          <li><i class="fa-solid fa-users-line"></i>
            <p><?php echo $hoten; ?></p>
          </li>
          <li><i class="fas fa-qrcode"></i>
            <a href="/BTL_PHP/giangvien/qld/qldiem.php">Quản lý điểm</a>
          </li>
          <li>
            <i class="fas fa-link"></i>
            <a href="/BTL_PHP/giangvien/lich.php">Xem lịch</a>
          </li>
          <li>
            <form action="" method="post">
              <a href="/BTL_PHP/giangvien/giangvien.php">Quay lại</a>
            </form>
          </li>
        </ul>
      </div>
      <div class="social_media">
        

          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>

        
      </div>
    </div>
  </div>
  </div>

    <div class="right-table">
     
      <form action="" method="post">
        <table id="myTable">
          <tr>
            <th>STT</th>
            <th>Mã GV</th>
            <th>Họ tên giảng viên</th>
            <th>Môn</th>
            <th>Lịch</th>
          </tr>
          <?php
        require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");

        $sql3 = "SELECT * FROM qldiem 
                        JOIN giangvien ON qldiem.MaGV = giangvien.MaGV
                        JOIN monhoc ON monhoc.MaMon = qldiem.MaMon
                        WHERE giangvien.MaGV LIKE '%$mgv%'";
        $tgList = executeResult($sql3);

        $stt = 1;

        if (!empty($tgList)) {
          foreach ($tgList as $tg) {
            echo "<tr>
                            <td>" . $stt . "</td>
                            <td>" . $tg['MaGV'] . "</td>
                            <td>" . $tg['HoTen'] . "</td>
                            <td>" . $tg['TenMon'] . "</td>
                            <td>" . $tg['Lich'] . "</td>
                            </tr>";

            $stt++;
          }
        } else {
          echo "<tr><td colspan='5'>Không có lịch</td></tr>";
        }
        ?>
        </table>
      </form>
    </div>
  </div>
</body>

</html>
