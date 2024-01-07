<?php
    require_once("D:/PHP/xampp/htdocs/BTL_PHP/connect/connDB.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - QL người dùng</title>
    <link rel="stylesheet" href="/BTL_PHP/admin/admin.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            width: 90%;
        }
        .manage-container {

            margin-top: 10px;
            display: block;
            text-align: center;
        }

        .manage-button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .manage-button a {
            text-decoration: none;
        }

        .manage-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <nav class="sidebar">
        <a href="/BTL_PHP/admin/admin.html" class="logo"><i class="uil uil-apps"></i> Đại Học QNT</a>
        <div class="menu-content">
            <ul class="menu-items">
                <li class="item">
                    <a href="/BTL_PHP/admin/qllop/quanlylophoc.php"><i class="uil uil-list-ul"></i> Quản lý lớp học </a>
                </li>
                
                <li class="item">
                    <a href="/BTL_PHP/admin/qltk/quanlynguoidung.php"><i class="uil uil-user"></i> Quản lý người dùng</a>
                </li>
                
                <li class="item">
                    <a href="/BTL_PHP/admin/qlmon/quanlymonhoc.php"><i class="uil uil-book-open"></i> Quản lý môn học</a>
                </li>
                <li class="item">
                    <a href="/BTL_PHP/admin/qlsv/quanlysinhvien.php"><i class="uil uil-user"></i> Quản lý sinh viên</a>
                </li>
                <li class="item">
                    <a href="/BTL_PHP/admin/qlgv/quanlygiangvien.php"><i class="uil uil-user"></i> Quản lý giảng viên</a>
                </li>
                <li class="item">
                    <a href="/BTL_PHP/login/index.php"><i class="uil uil-heart"></i>Đăng xuất</a>
                </li>
            </ul>
        </div>
    </nav>
    <nav class="navbar"></nav>
    <main class="main" id="content">
        <form action="" method="post">
            <h1>Quản lý người dùng</h1>
            <div class="manage-container">
                <button class="manage-button" name="Them"> <a href="Them.php">Thêm</a></button>
                <input type="text" name="timkiem">
                <input type="submit" name="btnTim" value="Tìm Kiếm">
            </div>

            <table id="myTable">
                <tr>
                    <td><b>STT</b></td>
                    <td><b>Tên hiển thị</b></td>
                    <td><b>Email</b></td>
                    <td><b>Chức vụ</b></td>
                    <td><b>Tài khoản</b></td>
                    <td><b>Mật khẩu</b></td>
                    <td><b>Sửa</b></td>
                    <td><b>Xóa</b></td>
                </tr>
                <?php
                    if (isset($_POST["btnTim"])) {
                        $tim = $_POST['timkiem'];
                    
                        if (!empty($tim)) {
                            $sql = "SELECT * FROM taikhoan WHERE HoTen LIKE '%$tim%' OR Email LIKE '%$tim%' 
                                                            OR ChucVu LIKE '%$tim%' OR TaiKhoan LIKE '%$tim%'
                                                            OR MatKhau LIKE '%$tim%'";  
                        }else {
                            $sql = "SELECT * FROM taikhoan";
                        }   
                    }else {
                        $sql = "SELECT * FROM taikhoan";
                    }

                    $tkList = executeResult($sql);

                    $stt = 1;
            
                    if (!empty($tkList)) {
                        foreach ($tkList as $tk) {
                            echo "<tr>
                                <td>$stt</td>
                                <td>" . $tk["HoTen"] . "</td>
                                <td>" . $tk["Email"] . "</td>
                                <td>" . $tk["ChucVu"] . "</td>
                                <td>" . $tk["TaiKhoan"] . "</td>
                                <td>" . $tk["MatKhau"] . "</td>";

                            if ($tk["id"] == 1) {
                                echo "<td></td>
                                    <td></td>";
                            } else {
                                echo "<td><a href='Sua.php?id=" . $tk["id"] . "'>Sửa</a></td>
                                    <td><a href='Xoa.php?id=" . $tk["id"] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa?\")'>Xóa</a></td>";
                            }

                            echo "</tr>";
                
                            $stt++;
                        }
                    } else {
                        echo "<tr><td colspan='5'>Không có lớp học.</td></tr>";
                    }
                ?>
            </table>
        </form>
    </main>
    <script src="/BTL_PHP/admin/admin.js"></script>
</body>
</html>
