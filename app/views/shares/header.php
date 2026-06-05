<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE CLASSY - Premium Leather Shoes</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #fdfdfd;
            color: #111;
            overflow-x: hidden;
        }

        /* Menu Kính mờ (Glassmorphism) */
        .navbar {
            background-color: rgba(17, 17, 17, 0.9) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            color: #fff !important;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .navbar-brand span {
            color: #c89b3c;
        }

        .nav-link {
            color: #fff !important;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            margin: 0 10px;
            transition: 0.3s;
        }

        .nav-link:hover,
        .dropdown-item:hover {
            color: #c89b3c !important;
        }

        .dropdown-menu {
            background-color: rgba(34, 34, 34, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid #333;
            border-radius: 8px;
            margin-top: 15px;
        }

        .dropdown-item {
            color: #ccc;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            padding: 10px 20px;
            transition: 0.3s;
        }

        /* Banner có hiệu ứng Parallax nhẹ */
        .hero-banner {
            background: url('https://images.unsplash.com/photo-1614252262579-8bfa46cb5f62?q=80&w=1920') center center/cover fixed no-repeat;
            height: 450px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 60px;
        }

        .hero-banner::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.8));
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .hero-title {
            color: #c89b3c;
            font-weight: 400;
            font-size: 3.5rem;
            letter-spacing: 8px;
            margin-bottom: 15px;
        }

        .hero-subtitle {
            color: #fff;
            letter-spacing: 3px;
            font-weight: 300;
        }

        /* Nút bấm nâng cấp */
        .btn-gold {
            background-color: #111;
            color: #fff;
            border: 1px solid #111;
            border-radius: 6px;
            text-transform: uppercase;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 1px;
            padding: 12px 30px;
            transition: all 0.4s;
        }

        .btn-gold:hover {
            background-color: #c89b3c;
            border-color: #c89b3c;
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(200, 155, 60, 0.3);
        }

        .btn-outline-dark {
            border-radius: 6px;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 1px;
        }

        /* Card Sản Phẩm tinh tế hơn */
        .product-card {
            border: 1px solid #f0f0f0;
            border-radius: 12px;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            overflow: hidden;
            background: #fff;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border-color: #c89b3c;
        }

        .img-wrapper {
            padding: 25px;
            text-align: center;
            background: #fafafa;
        }

        .img-wrapper img {
            height: 230px;
            object-fit: cover;
            transition: 0.8s ease;
            border-radius: 6px;
        }

        .product-card:hover .img-wrapper img {
            transform: scale(1.08);
        }

        .form-control,
        .custom-select {
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 12px 15px;
        }

        .form-control:focus {
            border-color: #c89b3c;
            box-shadow: 0 0 0 0.2rem rgba(200, 155, 60, 0.2);
        }

        .custom-card {
            background: #fff;
            border: 1px solid #f0f0f0;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.03);
        }

        footer {
            background-color: #0a0a0a;
            color: #888;
            padding: 60px 0 20px;
            margin-top: 80px;
        }

        footer h5 {
            color: #fff;
            letter-spacing: 2px;
            font-size: 1rem;
            margin-bottom: 25px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/WebBanGiay/Home">THE <span>CLASSY</span></a>
            <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarNav">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto align-items-center">

                    <li class="nav-item">
                        <a class="nav-link text-uppercase font-weight-bold px-3" href="/WebBanGiay/Home"
                            style="color: #fff; letter-spacing: 1px;">Trang chủ</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-uppercase font-weight-bold px-3" href="/WebBanGiay/Product/"
                            style="color: #fff; letter-spacing: 1px;">Sản phẩm</a>
                    </li>

                    <li class="nav-item mr-3">
                        <a class="nav-link text-uppercase font-weight-bold px-3" href="/WebBanGiay/Cart/"
                            style="color: #c89b3c !important; letter-spacing: 1px; position: relative;">
                            <i class="fas fa-shopping-cart" style="font-size: 1.1rem;"></i> Giỏ hàng
                            <span id="cart-count" class="badge badge-pill shadow-sm"
                                style="background-color: #dc3545; color: #fff; font-size: 0.7rem; position: absolute; top: -5px; right: 0px;">
                                <?php
                                $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                                echo $cart_count;
                                ?>
                            </span>
                        </a>
                    </li>

                    <?php if (SessionHelper::isAdmin()): ?>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase font-weight-bold px-3 text-warning"
                                href="/WebBanGiay/Category/" style="letter-spacing: 1px;">
                                <i class="fas fa-tags mr-1"></i> Quản lý danh mục
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase font-weight-bold px-3 text-warning"
                                href="/WebBanGiay/Product/add/" style="letter-spacing: 1px;">
                                <i class="fas fa-plus-circle mr-1"></i> Quản lý sản phẩm
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (SessionHelper::isLoggedIn()): ?>
                        <li class="nav-item">
                            <span class="nav-link px-3" style="color: #c89b3c; font-weight: 600;">
                                <i class="fas fa-user-circle mr-1"></i> <?= htmlspecialchars($_SESSION['username']) ?>
                                <small class="badge badge-secondary ml-1"
                                    style="font-size: 10px; background: #333; color: #fff; border: 1px solid #c89b3c;"><?= SessionHelper::getRole() ?></small>
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-light btn-sm ml-2 px-3" href="/WebBanGiay/Account/logout"
                                style="border-radius: 20px; border-color: #444; font-size: 12px; letter-spacing: 1px;">
                                ĐĂNG XUẤT <i class="fas fa-sign-out-alt ml-1"></i>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase font-weight-bold px-3" href="/WebBanGiay/Account/login"
                                style="color: #c89b3c; letter-spacing: 1px;">Đăng nhập</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-gold btn-sm ml-2 px-3 font-weight-bold" href="/WebBanGiay/Account/register"
                                style="background: #c89b3c; color: #111; border-radius: 20px; font-size: 12px;">
                                ĐĂNG KÝ
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>