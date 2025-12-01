<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/banDT/banDienThoaiGlobal.css"/>
    <link rel="stylesheet" href="asset/css/banDT/banDienThoai_Header.css"/>
    <link rel="stylesheet" href="asset/css/banDT/cssMobile.css"/>
    <link rel="stylesheet" href="asset/css/banDT/reponsive-grid.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Chi tiet san pham</title>
</head>
<body>
    <header>
        <div class="wrap-menu-header">
            <nav class="tim-kiem-dang-nhap-gio-hang d-flex">
                <span class="logo">TechSTU</span>
                <div class="dang-nhap-gio-hang d-flex">
                    <div class="tim-kiem flex-1">
                        <input type="text" placeholder="... tim kiem">
                        <button>
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                    <a href="" class="gio-hang d-flex align-center">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="" id="gio-hang">0</span>
                    </a>
                    <a href="" class="dang-nhap d-flex align-center">
                        <i class="fa-solid fa-circle-user"></i>
                        <span>Log in</span>
                    </a>
                </div>
            </nav>
        </div>
        <nav class="danh-sach-loai-san-pham">
            <ul class="d-flex align-center list-menu">
                <li><a href="">SHOP ALL</a></li>
                <li><a href="">OPPO</a></li>
                <li><a href="">TECNO</a></li>
                <li><a href="">SAMSUNG</a></li>
                <li><a href="">APPLE</a></li>
                <li><a href="">XIAOMI</a></li>
                <li><a href="">TAI NGHE</a></li>
                <li><a href="">SẠC DỰ PHÒNG</a></li>
            </ul>
        </nav>

        <!-- menu cua dien thoai -->
        <nav class="menu-cua-dien-thoai">
            <div class="header-dien-thoai">
                <span class="logo">TechSTU</span>
            
                <div class="menu-mobile">
                    <div class="menu-mobile-tim-kiem">
                        <div class="tim-kiem">
                            <button>
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                        <div class="modal-mobile"></div>
                    </div>
                    <div class="menu-mobile-gio-hang">
                        <a href="" class="gio-hang display-center">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="" id="gio-hang">0</span>
                        </a>
                    </div>
                    <div class="menu-mobile-button">
                        <div class="menu-mobile-1"></div>
                        <div class="menu-mobile-1"></div>
                        <div class="menu-mobile-1"></div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="chi-tiet">
        <div style="width: 900px;margin: auto;">
            <section style="padding: 3rem 0;font-size: 1.6rem;">
                <a href="banDienThoai.html">Home\</a>
                <span style="font-size: 1.2rem;opacity: 0.6;">JP - Space Tablet 10.4" Wi-Fi 32GB</sapn>
            </section>
    
            <section class="d-flex">
                <div style="margin-right:2rem;">
                    <img src="images/san-pham-1.png" alt="anh-san-pham" width="500px">
                </div>
                <form action="" method="post">
                   <div>
                        <p style="font-size: 2rem;font-weight: bold;">JP - Space Tablet 10.4" Wi-Fi 32GB</p>
                        <div style="font-size: 1rem; margin: 1rem 0;">
                            <span class="gia-goc">gia goc</span>
                            <span>gia sale</span>
                        </div>
                        <button class="btnShop txt-white bg-purple" style="width: 100%;">Thêm vào giỏ</button>
                        <button class="btnShop txt-white bg-black" style="width: 100%;">Mua ngay</button>
    
                        <div style="margin-top: 3rem;">
                            <div class="d-flex align-center justify-between" style="cursor: pointer;">
                                <h4>Thông tin sản phẩm</h4>
                                <span id="product-info" style="font-size: 2rem;">+</span>
                            </div>
                           
                            <p class="chi-tiet-mo-ta" id="chi-tiet-mo-ta">
                                I'm a product detail. 
                                I'm a great place to add more information about your product such as sizing, 
                                material, care and cleaning instructions. This is also a great space to 
                                write what makes this product special and how your customers can benefit from this item.
                            </p>
                        </div>
                   </div>
                </form>
            </section>
    
            
        </div>
        <section class="">
            <h2 class="" style="margin-left: 70px;">Có thể bạn quan tâm</h2>

            <div class="wrap-list-san-pham d-flex align-center">
                <div class="btn-pre" id="btn-next">&#10094;</div>

                <div class="san-pham-gioi-thieu">
                    <span class="logo-sale">
                        SALE
                    </span>
                    <div class="bg-white">
                        <a href="chi-tiet-DT.html">
                            <img src="/images/san-pham-1.png" alt="sanpham" class="" width="100%" style="display:block;margin: auto;">
                        </a>
                    </div>
                    <div style="padding: 1rem;">
                        <p class="">JP - Space Tablet 10.4" Wi-Fi 32GB</p>
                        <div class="display-center justify-space-between">
                            <p class="">
                                <span class="gia-goc"> $85.00</span>
                                <span class="gia-sale">$70.00</span>
                            </p>
                        </div>
                    </div>
                </div>

               
                <div class="btn-next" id="btn-pre">&#10095;</div>
            </div>
        </section>
    </main>
    <footer class="bg-white">
        <section class="d-flex">
            <div class="vi-tri-shop item-footer d-flex flex-direction-col align-center">
                <h2>Vị trí shop</h2>
                
                <ul class="">

                </ul>
            </div>
            <div class="ho-tro item-footer d-flex flex-direction-col align-center">
                <h2 style="margin: 0 auto;">Hỗ trợ khách hàng</h2>
                
                <ul class="">
                    <li><a href="">Liên hệ với chúng tôi</a></li>
                    <li><a href="">Trung tâm hỗ trợ</a></li>
                    <li><a href="">Thông tin của chúng tôi</a></li>
                    <li><a href="">Ứng tuyển</a></li>
                </ul>
            </div>
            <div class="chinh-sach item-footer d-flex flex-direction-col align-center">
                <h2>Chính sách của shop</h2>
                
                <ul class="">
                    <li><a href="">Hoàn trả & ship</a></li>
                    <li><a href="">Chính sách & dịch vụ</a></li>
                    <li><a href="">Phương thức thanh toán</a></li>
                </ul>
            </div>
        </section>
        <section>
            <hr>
        </section>
       
        <section>
            <h4></h4>
            <div>
                
            </div>
        </section>
    </footer>
    <script src="js/banDT/banDienThoai.js"></script>
</body>
</html>