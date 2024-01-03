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
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giảng viên - QL điểm</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  </head>
  <body>
    <div class="main_box">
      <input type="checkbox" name="check" id="check">
      <div class="btn_one">
        <label for="check">
          <i class="fas fa-bars"></i>
        </label>
      </div>
      <div class="sidebar_menu">
        <div class="logo">
          <a href="#">Giảng Viên QNT </a>
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
          <ul>
        
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="right-table">
      
    <form action="" method="post">
        <div class="manage-container">
            <button class="manage-button" name="Them"> <a href="Them.php">Thêm</a></button>
            <input type="text" name="timkiem">
            <input type="submit" name="btnTim" value="Tìm Kiếm">
        </div>

        <table id="myTable" border=1>
            <tr>
                <td><b>STT</b></td>
                <td><b>MSV</b></td>
                <td><b>Họ tên sinh viên</b></td>
                <td><b>Môn</b></td>
                <td><b>Chuyên cần</b></td>
                <td><b>Giữa kỳ</b></td>
                <td><b>Cuối kỳ</b></td>
                <td><b>TB</b></td>
                <td><b>Sửa</b></td>
                <td><b>Xóa</b></td>
            </tr>
            <?php
                if (isset($_POST["btnTim"])) {
                    $tim = $_POST['timkiem'];
                
                    if (!empty($tim)) {
                      $sql = "SELECT * FROM qldiem 
                            LEFT JOIN sinhvien ON qldiem.MSV = sinhvien.MSV
                            JOIN  monhoc ON qldiem.MaMon = monhoc.MaMon
                            WHERE sinhvien.MSV LIKE '%$tim%' OR sinhvien.HoTen LIKE '%$tim%' 
                            OR qldiem.MaMon LIKE '%$tim%' OR qldiem.ChuyenCan LIKE '%$tim%'
                            OR qldiem.GiuaKy LIKE '%$tim%' OR qldiem.CuoiKy LIKE '%$tim%'
                            OR monhoc.TenMon LIKE '%$tim%'";
                    }else {
                      $sql = "SELECT * FROM qldiem 
                          JOIN sinhvien ON qldiem.MSV = sinhvien.MSV
                          JOIN  monhoc ON qldiem.MaMon = monhoc.MaMon";
                    }   
                }else {
                  $sql = "SELECT * FROM qldiem 
                          JOIN sinhvien ON qldiem.MSV = sinhvien.MSV
                          JOIN  monhoc ON qldiem.MaMon = monhoc.MaMon";
                }

                $diemList = executeResult($sql);

                $stt = 1;
        
                if (!empty($diemList)) {
                    foreach ($diemList as $diem) {
                        echo "<tr>
                            <td>$stt</td>
                            <td>" . $diem["MSV"] . "</td>
                            <td>" . $diem["HoTen"] . "</td>
                            <td>" . $diem["TenMon"] . "</td>
                            <td>" . $diem["ChuyenCan"] . "</td>
                            <td>" . $diem["GiuaKy"] . "</td>
                            <td>" . $diem["CuoiKy"] . "</td>
                            <td>" . $diem["DiemTB"]. "</td>
                            <td><a href='Sua.php?id=" . $diem["id"] . "'>Sửa</a></td>
                            <td><a href='Xoa.php?id=" . $diem["id"] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa?\")'>Xóa</a></td>
                            </tr>";
            
                        $stt++;
                    }
                } else {
                    echo "<tr><td colspan='10'>Không có dữ liệu.</td></tr>";
                }
            ?>
        </table>
    </form>
  </div>
</div>
  </body>
</html>
