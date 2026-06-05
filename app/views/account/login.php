<?php include 'app/views/shares/header.php'; ?>

<section class="py-5" style="background-color: #111; min-height: 80vh;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white shadow-lg border-0" style="border-radius: 1rem; background-color: #161616 !important;">
                    <div class="card-body p-5 text-center">

                        <form action="/WebBanGiay/Account/checkLogin" method="post">
                            <h2 class="fw-bold mb-2 text-uppercase" style="color: #c89b3c; letter-spacing: 2px;">GENTLEMAN'S LOGIN</h2>
                            <p class="text-white-50 mb-5">Vui lòng đăng nhập để tiếp tục trải nghiệm</p>

                            <?php if(isset($error)): ?>
                                <div class="alert alert-danger" style="border-radius: 8px;"><?= $error ?></div>
                            <?php endif; ?>

                            <div class="form-outline form-white mb-4 text-left">
                                <label class="form-label font-weight-bold" style="color: #c89b3c;">Tên đăng nhập</label>
                                <input type="text" name="username" class="form-control form-control-lg bg-dark text-white border-secondary" placeholder="Nhập username" required />
                            </div>

                            <div class="form-outline form-white mb-4 text-left">
                                <label class="form-label font-weight-bold" style="color: #c89b3c;">Mật khẩu</label>
                                <input type="password" name="password" class="form-control form-control-lg bg-dark text-white border-secondary" placeholder="Nhập mật khẩu" required />
                            </div>

                            <button class="btn font-weight-bold btn-lg px-5 mt-3" style="background: #c89b3c; color: #111; border-radius: 30px; transition: 0.3s;" type="submit">
                                ĐĂNG NHẬP
                            </button>

                            <div class="mt-4">
                                <p class="mb-0 text-white-50">Chưa có tài khoản? <a href="/WebBanGiay/Account/register" class="font-weight-bold" style="color: #c89b3c;">Đăng ký ngay</a></p>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'app/views/shares/footer.php'; ?>