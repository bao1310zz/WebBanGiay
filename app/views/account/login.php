<?php include 'app/views/shares/header.php'; ?>

<section class="py-5" style="background-color: #111; min-height: 80vh;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white shadow-lg border-0" style="border-radius: 1rem; background-color: #161616 !important;">
                    <div class="card-body p-5 text-center">

                        <form id="login-form" action="/WebBanGiay/Account/checkLogin" method="post">
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

<script>
document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Chặn hành vi tải lại trang mặc định của form

    const formData = new FormData(this);
    const jsonData = {};
    formData.forEach((value, key) => { 
        jsonData[key] = value; 
    });

    // Gửi dữ liệu đi bằng Fetch API
    fetch('/WebBanGiay/Account/checkLogin', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(jsonData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.token) {
            // Đăng nhập thành công -> Lưu Token vào bộ nhớ trình duyệt
            localStorage.setItem('jwtToken', data.token);
            // Chuyển hướng sang trang quản lý sản phẩm
            location.href = '/WebBanGiay/Product';
        } else {
            alert('Đăng nhập thất bại: Vui lòng kiểm tra lại tài khoản hoặc mật khẩu!');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Lỗi kết nối đến hệ thống!');
    });
});
</script>