<?php include 'app/views/shares/header.php'; ?>

<section class="py-5" style="background-color: #111; min-height: 80vh;">
    <div class="container py-4 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card bg-dark text-white shadow-lg border-0" style="border-radius: 1rem; background-color: #161616 !important;">
                    <div class="card-body p-5">

                        <h2 class="text-center fw-bold mb-4 text-uppercase" style="color: #c89b3c; letter-spacing: 2px;">GIA NHẬP THE CLASSY</h2>
                        
                        <?php if (isset($errors) && count($errors) > 0): ?>
                            <div class="alert alert-danger" style="border-radius: 8px;">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $err): ?>
                                        <li><?= $err ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="/WebBanGiay/Account/save" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label" style="color: #c89b3c;">Tên đăng nhập *</label>
                                    <input type="text" name="username" class="form-control bg-dark text-white border-secondary" required />
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label" style="color: #c89b3c;">Họ và tên *</label>
                                    <input type="text" name="fullname" class="form-control bg-dark text-white border-secondary" required />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label" style="color: #c89b3c;">Mật khẩu *</label>
                                    <input type="password" name="password" class="form-control bg-dark text-white border-secondary" required />
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label" style="color: #c89b3c;">Xác nhận mật khẩu *</label>
                                    <input type="password" name="confirmpassword" class="form-control bg-dark text-white border-secondary" required />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label class="form-label" style="color: #c89b3c;">Số điện thoại</label>
                                    <input type="text" name="phone" class="form-control bg-dark text-white border-secondary" />
                                </div>
                                <div class="col-md-8 mb-4">
                                    <label class="form-label" style="color: #c89b3c;">Email liên hệ</label>
                                    <input type="email" name="email" class="form-control bg-dark text-white border-secondary" required />
                                </div>
                            </div>

                            <div class="mb-5">
                                <label class="form-label" style="color: #c89b3c;">Địa chỉ</label>
                                <input type="text" name="address" class="form-control bg-dark text-white border-secondary" />
                            </div>

                            <div class="text-center">
                                <button class="btn font-weight-bold btn-lg px-5" style="background: #c89b3c; color: #111; border-radius: 30px;" type="submit">
                                    ĐĂNG KÝ TÀI KHOẢN
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'app/views/shares/footer.php'; ?>