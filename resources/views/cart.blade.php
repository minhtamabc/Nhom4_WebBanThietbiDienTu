<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
        }
        
        .navbar {
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .navbar h1 {
            color: #667eea;
            font-size: 24px;
        }
        
        .nav-links {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        
        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 600;
            padding: 8px 15px;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .nav-links a:hover {
            background: #667eea;
            color: white;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .clear-btn {
            background: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        
        .clear-btn:hover {
            background: #c82333;
        }
        
        .cart-table {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th {
            text-align: left;
            padding: 15px;
            border-bottom: 2px solid #ddd;
            color: #333;
            font-weight: 600;
        }
        
        td {
            padding: 20px 15px;
            border-bottom: 1px solid #eee;
        }
        
        .product-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .product-name {
            font-weight: 600;
            color: #333;
        }
        
        .product-meta {
            color: #666;
            font-size: 14px;
        }
        
        .quantity-form {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .quantity-input {
            width: 70px;
            padding: 8px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        
        .update-btn {
            padding: 8px 15px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
        }
        
        .update-btn:hover {
            background: #5568d3;
        }
        
        .remove-btn {
            color: #dc3545;
            text-decoration: none;
            font-weight: 600;
        }
        
        .remove-btn:hover {
            color: #c82333;
        }
        
        .cart-summary {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-top: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        
        .summary-row:last-child {
            border-bottom: none;
            font-size: 24px;
            font-weight: 700;
            color: #667eea;
        }
        
        .checkout-btn {
            width: 100%;
            padding: 15px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
        }
        
        .checkout-btn:hover {
            background: #218838;
        }
        
        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 15px;
        }
        
        .empty-cart-icon {
            font-size: 80px;
            margin-bottom: 20px;
        }
        
        .continue-shopping {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
        }
        
        .continue-shopping:hover {
            background: #5568d3;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>📱 Quản lý bán điện thoại</h1>
        <div class="nav-links">
            <a href="/">Trang chủ</a>
            <a href="{{ route('products') }}">Sản phẩm</a>
            <a href="{{ route('cart.index') }}">🛒 Giỏ hàng</a>
            @if(session('user_id'))
                <span>{{ session('user_name') }}</span>
                <a href="{{ route('logout') }}">Đăng xuất</a>
            @else
                <a href="{{ route('login') }}">Đăng nhập</a>
            @endif
        </div>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if($cartItems->count() > 0)
            <div class="cart-header">
                <h2 style="color: #333;">🛒 Giỏ hàng của bạn ({{ $cartItems->count() }} sản phẩm)</h2>
                <a href="{{ route('cart.clear') }}" class="clear-btn" onclick="return confirm('Bạn có chắc muốn xóa toàn bộ giỏ hàng?')">Xóa tất cả</a>
            </div>

            <div class="cart-table">
                <table>
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                        <tr>
                            <td>
                                <div class="product-info">
                                    <span class="product-name">{{ $item->name }}</span>
                                    <span class="product-meta">🏷️ {{ $item->attributes->hang }}</span>
                                    <span class="product-meta">📦 {{ $item->attributes->loai }}</span>
                                </div>
                            </td>
                            <td>{{ number_format($item->price, 0, ',', '.') }}₫</td>
                            <td>
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="quantity-form">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->attributes->ton_kho }}" class="quantity-input">
                                    <button type="submit" class="update-btn">Cập nhật</button>
                                </form>
                            </td>
                            <td style="font-weight: 600; color: #667eea;">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫</td>
                            <td>
                                <a href="{{ route('cart.remove', $item->id) }}" class="remove-btn" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">❌ Xóa</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="cart-summary">
                <div class="summary-row">
                    <span>Tạm tính:</span>
                    <span>{{ number_format($total, 0, ',', '.') }}₫</span>
                </div>
                <div class="summary-row">
                    <span>Phí vận chuyển:</span>
                    <span>Miễn phí</span>
                </div>
                <div class="summary-row">
                    <span>Tổng cộng:</span>
                    <span>{{ number_format($total, 0, ',', '.') }}₫</span>
                </div>
                <button class="checkout-btn" onclick="alert('Chức năng thanh toán đang phát triển!')">💳 Thanh toán</button>
            </div>
        @else
            <div class="empty-cart">
                <div class="empty-cart-icon">🛒</div>
                <h2 style="color: #666; margin-bottom: 10px;">Giỏ hàng trống</h2>
                <p style="color: #999;">Bạn chưa có sản phẩm nào trong giỏ hàng</p>
                <a href="{{ route('products') }}" class="continue-shopping">Tiếp tục mua sắm</a>
            </div>
        @endif
    </div>
</body>
</html>