<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm</title>
    <style>
        body { font-family: Arial; background: #f7f7f7; margin: 0; padding: 20px; }
        a { text-decoration: none; }
        .btn { padding: 10px 15px; background: #28a745; color: #fff; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; }
        th, td { padding: 12px; border: 1px solid #ccc; text-align: center; }
        th { background: #e5e5e5; }
    </style>
</head>
<body>

<h1>Quản lý sản phẩm</h1>
<a href="index.html">⬅ Quay lại trang chủ</a>
<br><br>

<a href="#" class="btn">+ Thêm sản phẩm</a>

<table>
    <tr>
        <th>ID</th>
        <th>Tên sản phẩm</th>
        <th>Giá</th>
        <th>Hình ảnh</th>
        <th>Hành động</th>
    </tr>
    <tr>
        <td>1</td>
        <td>Tai nghe Sony WH-1000XM4</td>
        <td>6.500.000đ</td>
        <td><img src="https://via.placeholder.com/60"></td>
        <td>
            <a href="#" style="color: blue;">Sửa</a> |
            <a href="#" style="color: red;">Xóa</a>
        </td>
    </tr>
</table>

</body>
</html>
