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

  require('Classes/PHPExcel.php');
  $conn = mysqli_connect('localhost', 'root', '', 'qldsv');

  if (isset($_POST['btnEx'])) {
    $objExcel = new PHPExcel;
    $objExcel->setActiveSheetIndex(0);
    $sheet = $objExcel->getActiveSheet()->setTitle('Bảng điểm');

    $rowCount = 1;
    $sheet->setCellValue('A'.$rowCount, 'Msv');
    $sheet->setCellValue('B'.$rowCount, 'Họ Tên');
    $sheet->setCellValue('C'.$rowCount, 'Tên môn');
    $sheet->setCellValue('D'.$rowCount, 'Chuyên cần');
    $sheet->setCellValue('E'.$rowCount, 'Giữa kỳ');
    $sheet->setCellValue('F'.$rowCount, 'Cuối kỳ');
    $sheet->setCellValue('G'.$rowCount, 'Điểm TB');

    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $styleArray = array(
      'fill' => array(
        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('argb' => '00ffff00')
      ),
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
      )
    );
    $sheet->getStyle('A1:G1')->applyFromArray($styleArray);

    $result = $conn->query("SELECT qldiem.MSV, sinhvien.HoTen, monhoc.TenMon, qldiem.ChuyenCan, qldiem.GiuaKy, qldiem.CuoiKy, qldiem.DiemTB
                            FROM qldiem JOIN sinhvien ON qldiem.MSV=sinhvien.MSV
                                        JOIN monhoc ON qldiem.MaMon=monhoc.MaMon;");
    while($row = mysqli_fetch_array($result)){
      $rowCount++;
      $sheet->setCellValue('A'.$rowCount, $row['MSV']);
      $sheet->setCellValue('B'.$rowCount, $row['HoTen']);
      $sheet->setCellValue('C'.$rowCount, $row['TenMon']);
      $sheet->setCellValue('D'.$rowCount, $row['ChuyenCan']);
      $sheet->setCellValue('E'.$rowCount, $row['GiuaKy']);
      $sheet->setCellValue('F'.$rowCount, $row['CuoiKy']);
      $sheet->setCellValue('G'.$rowCount, $row['DiemTB']);
    }

    $styleArray = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_border::BORDER_THIN
        )
      )
    );
    $sheet->getStyle('A1:' . 'G'.($rowCount))->applyFromArray($styleArray);

    $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
    $filename = 'bangdiem.xlsx';
    $objWriter->save($filename);

    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
    header('Content-Length: ' . filesize($filename));
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: no-cache');
    readfile($filename);
    return;
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giảng viên</title>
    <link rel="stylesheet" href="/BTL_PHP/giangvien/giangvien.css">
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
          <a href="/BTL_PHP/giangvien/giangvien.php
          ">Giảng Viên QNT </a>
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
                <button name="btnEx" class="btnEx">Xuất bảng điểm</button>
              </form>      
            </li>
            <li><i class="fas fa-qrcode"></i>
              <a href="/BTL_PHP/login/index.php">Đăng xuất</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
  </body>
</html>
