<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
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
        
        .cart-btn {
            background: #28a745;
            color: white !important;
            padding: 10px 20px !important;
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
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }
        
        .product-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .product-icon {
            font-size: 60px;
            text-align: center;
            margin-bottom: 15px;
        }
        
        .product-name {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }
        
        .product-info {
            color: #666;
            font-size: 14px;
            margin-bottom: 8px;
        }
        
        .product-price {
            font-size: 24px;
            font-weight: 700;
            color: #667eea;
            margin: 15px 0;
        }
        
        .stock {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .in-stock {
            background: #d4edda;
            color: #155724;
        }
        
        .out-stock {
            background: #f8d7da;
            color: #721c24;
        }
        
        .add-to-cart-form {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .quantity-input {
            width: 60px;
            padding: 8px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        
        .add-btn {
            flex: 1;
            padding: 10px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .add-btn:hover {
            background: #5568d3;
        }
        
        .add-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>📱 Quản lý bán điện thoại</h1>
        <div class="nav-links">
            <a href="/">Trang chủ</a>
            <a href="{{ route('products') }}">Sản phẩm</a>
            <a href="{{ route('cart.index') }}" class="cart-btn">🛒 Giỏ hàng</a>
            @if(session('user_id'))
                <span>{{ session('user_name') }}</span>
                <a href="{{ route('logout') }}">Đăng xuất</a>
            @else
                <a href="{{ route('login') }}">Đăng nhập</a>
            @endif
        </div>
    </div>

    <div class="container">
        <h2 style="margin-bottom: 20px; color: #333;">Danh sách sản phẩm</h2>

        @if(session('success'))
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                ❌ {{ session('error') }}
            </div>
        @endif

        <div class="products-grid">
            @foreach($products as $product)
            <div class="product-card">
                <div class="product-icon">📱</div>
                <div class="product-name">{{ $product->ten }}</div>
                <div class="product-info">🏷️ Hãng: {{ $product->ten_hang }}</div>
                <div class="product-info">📦 Loại: {{ $product->ten_loai_sp }}</div>
                <div class="product-price">{{ number_format($product->gia_ban, 0, ',', '.') }}₫</div>
                
                @if($product->so_luong_ton_kho > 0)
                    <span class="stock in-stock">Còn {{ $product->so_luong_ton_kho }} sản phẩm</span>
                    <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id_chi_tiet_thiet_bi }}">
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->so_luong_ton_kho }}" class="quantity-input">
                        <button type="submit" class="add-btn">Thêm vào giỏ</button>
                    </form>
                @else
                    <span class="stock out-stock">Hết hàng</span>
                    <button class="add-btn" disabled>Hết hàng</button>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>