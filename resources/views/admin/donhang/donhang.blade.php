<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách đơn hàng</title>
    <style>
        body { font-family: Arial; background: #f7f7f7; padding: 20px; }
        table { width: 100%; background: #fff; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 12px; text-align: center; }
        th { background: #eee; }
        .btn { padding: 6px 12px; color: white; border-radius: 4px; }
        .btn-xacnhan { background: #007bff; }
        a { text-decoration: none; }
    </style>
</head>
<body>

<h1>Danh sách đơn hàng</h1>
<a href="index.html">⬅ Quay lại trang chủ</a>

<table>
    <tr>
        <th>Mã ĐH</th>
        <th>Khách hàng</th>
        <th>Tổng tiền</th>
        <th>Trạng thái</th>
        <th>Hành động</th>
    </tr>
    <tr>
        <td>DH001</td>
        <td>Nguyễn Văn A</td>
        <td>3.200.000đ</td>
        <td>Chờ xác nhận</td>
        <td>
            <a href="xacnhan.html" class="btn btn-xacnhan">Xác nhận</a>
        </td>
    </tr>
</table>

</body>
</html>
