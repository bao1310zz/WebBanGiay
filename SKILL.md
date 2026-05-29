# Skill Name: WebBanGiay PHP MVC Development & Error Assistant

## Description
Kỹ năng này cấu hình cho AI Agent cách hỗ trợ lập trình viên quản lý tiến độ, phát hiện lỗi hệ thống, kiểm thử các tính năng cốt lõi (CRUD, Giỏ hàng, Thanh toán) và tự động cập nhật nhật ký thay đổi (Changelog) cho dự án WebBanGiay (PHP MVC, MySQL, Bootstrap 4).

## Trigger Rules (Khi nào sử dụng)
Sử dụng skill này khi người dùng yêu cầu:
1. "Kiểm tra lỗi/Fix bug cho dự án WebBanGiay"
2. "Viết nhật ký code / Cập nhật tiến độ dự án"
3. "Kiểm thử luồng giỏ hàng hoặc quản lý sản phẩm"
4. Gửi kèm ảnh chụp màn hình chứa thông báo lỗi PHP (Warning, Fatal error, PDOException).

## Input Requirements
- **Source Code Path:** Toàn bộ thư mục `app/` (Controllers, Models, Views) và `public/`.
- **Database Context:** Tên database mặc định là `webbangiay`. Các bảng chính: `product`, `category`, `orders`, `order_details`.
- **Error Log/Screenshot:** Nội dung lỗi hoặc mô tả hành vi sai lệch của ứng dụng.

## Core Workflows & Instructions for Agent

### Quy trình 1: Phân tích và Khắc phục lỗi (Error Management)
Khi phát hiện lỗi hoặc nhận được yêu cầu sửa lỗi, Agent phải tuân thủ quy trình kiểm tra các "điểm đen" kinh điển của mô hình MVC này:

1. **Lỗi Kết nối & Tên bảng (PDOException):**
   - Kiểm tra file `app/config/database.php` xem tên database có bị ghi sai hoặc trỏ nhầm sang database cũ (`my_store`) hay không.
   - Kiểm tra thuộc tính `$table_name` trong các file Model (`ProductModel.php`, `CategoryModel.php`) để đảm bảo không bị dính tiền tố cứng (hardcoded) của database cũ.

2. **Lỗi Định dạng Giỏ hàng (Session Mismatch):**
   - Nếu gặp lỗi `Trying to access array offset on value of type int` tại file `cart.php`, xác định ngay nguyên nhân do Session đang lưu dạng số cũ (số lượng) thay vì cấu trúc mảng mới (`name`, `price`, `quantity`, `image`).
   - Hướng dẫn lập trình viên tích hợp cơ chế tự dọn rác (防 ngắt định dạng) bằng cách quét `$_SESSION['cart']` và `unset` các phần tử không phải mảng trong `ProductController.php`.

3. **Lỗi Định tuyến (Action not found):**
   - Kiểm tra các thẻ `<form action="...">` hoặc thẻ `<a href="...">` tại các file View xem đường dẫn URL đã khớp cấu trúc `/[Controller]/[Action]/[ID]` chưa.
   - Đặc biệt lưu ý luồng xử lý giỏ hàng mới phải trỏ về `ProductController` (`/Product/addToCart/` và `/Product/updateCart`) thay vì `CartController` cũ.

### Quy trình 2: Quản lý và Tự động viết Nhật ký Code (Automated Logging)
Sau mỗi lần lập trình viên sửa code thành công hoặc tối ưu giao diện (như thêm Slider động, sửa nút tăng giảm số lượng), Agent có nhiệm vụ tự động cập nhật vào file `CHANGELOG.md` ở thư mục gốc của dự án theo cấu trúc sau:

```markdown
### [Ngày/Tháng/Năm] - Cập nhật Chức năng [Tên chức năng]
- **Vấn đề xử lý:** [Mô tả lỗi hoặc yêu cầu cải tiến từ người dùng]
- **Các file thay đổi:**
  - `app/controllers/...` (Mô tả ngắn gọn dòng code thay đổi)
  - `app/views/...` (Mô tả giao diện hoặc mã JS/AJAX cập nhật)
- **Hard skills vận dụng:** [Ví dụ: PHP Session, PDO Transaction, AJAX Fetch API, Bootstrap Carousel]
- **Trạng thái:** Hoàn thành / Đã kiểm thử trơn tru.