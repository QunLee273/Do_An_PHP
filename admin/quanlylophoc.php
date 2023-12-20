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
            <tr><th>STT</th><th>Mã Lớp Học</th><th>Tên Lớp Học</th></tr>
            <tr><td>1</td><td></td><td></td></tr>
            <tr><td>2</td><td></td><td></td></tr>
            
        </table>

        
        <div class="manage-container">
            <button class="manage-button">Thêm</button>
            <button class="manage-button">Sửa</button>
            <button class="manage-button">Xóa</button><br>
            <input type="text" name="timkiem">
            <input type="submit" value="Tìm Kiếm ">
            
        </div>
        </form>
    </main>
</body>
</html>
