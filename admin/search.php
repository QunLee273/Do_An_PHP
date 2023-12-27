<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link rel="stylesheet" href="admin.css">
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

        .manage-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <nav class="sidebar">
        <a href="#" class="logo"><i class="uil uil-apps"></i> Đại Học QNT</a>
        <div class="menu-content">
            <ul class="menu-items">
                <li class="item">
                    <a href="quanlylophoc.php"><i class="uil uil-list-ul"></i> Quản Lý Lớp Học </a>
                </li>
                <li class="item">
                    <a href="#" onclick="showContent('Quản lý người dùng')"><i class="uil uil-user"></i> Quản lý người dùng</a>
                </li>
                <li class="item">
                    <a href="#" onclick="showContent('Quản Lý Môn Học')"><i class="uil uil-book-open"></i> Quản Lý Môn Học</a>
                </li>
                <li class="item">
                    <a href="#" onclick="showContent('Quản Lý Điểm')"><i class="uil uil-heart"></i> Quản Lý Điểm</a>
                </li>
            </ul>
        </div>
    </nav>
    <nav class="navbar"></nav>
    <main class="main" id="content">
        
        <form action="" method="post">
        <table>
            <tr>
                <td><b>STT</b></td>
                <td><b>Mã lớp</b></td>
                <td><b>Tên lớp</b></td>
                <td><b>Sửa</b></td>
                <td><b>Xóa</b></td>
            </tr>
            <?php
                $con = mysqli_connect('localhost', 'user_bt', 'pass_bt', 'bt');
                $tim = $_POST['timkiem'];

                $sql = "SELECT * FROM loaihang WHERE MaLoai LIKE '%$tim%' OR TenLoai LIKE '%$tim%'";
                $result = mysqli_query($con, $sql);

                $stt = 1;

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>$stt</td>";
                        echo "<td>" . $row["MaLoai"] . "</td>";
                        echo "<td>" . $row["TenLoai"] . "</td>";
                        echo "<td><a href='Sua.php?id=" . $row["MaLoai"] . "'>Sửa</a></td>";
                        echo "<td><a href='Xoa.php?id=" . $row["MaLoai"] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa?\")'>Xóa</a></td>";
                        echo "</tr>";

                        $stt++;
                    }
                } else {
                    echo "<tr><td colspan='5'>Không có kết quả tìm kiếm.</td></tr>";
                }
            ?>
        </table>

        <div class="manage-container">
            <button class="manage-button" name="Them">Thêm</button>
            <input type="text" id="tim" name="timkiem">
            <input type="submit" name="btnTim" value="Tìm Kiếm ">
        </div>
        <?php
            if(isset($_POST["btnTim"])){
                header("Location: search.php");
                exit;
            }
        ?>
        </form>
    </main>
</body>
</html>
