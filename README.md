# 🎓 Quản Lý Khóa Học

> Dự án **Quản Lý Khóa Học** được xây dựng bằng Laravel, giúp quản lý các khóa học với các chức năng thêm, sửa, xóa và tìm kiếm.

## 📌 **Tính Năng Chính**
👉 Quản lý danh sách khóa học  
👉 Thêm, sửa, xóa khóa học  
👉 Tìm kiếm và sắp xếp danh sách khóa học  
👉 Giao diện đẹp, hiện đại với Bootstrap  
👉 Xác nhận khi xóa khóa học bằng SweetAlert  
👉 Tự động chuyển hướng từ `/` sang `/courses`

---

## 🛠 **Công Nghệ Sử Dụng**
- **Backend:** Laravel 11
- **Frontend:** Bootstrap 5, DataTables, SweetAlert
- **Cơ sở dữ liệu:** SQLite (hoặc MySQL)

---

## 🚀 **Hướng Dẫn Cài Đặt**

### 🔹 **1. Clone repository**
```sh
git clone https://github.com/MowX204/btl_web_nang_cao.git
cd btl_web_nang_cao/course-management
```

### 🔹 **2. Cài đặt Composer & NPM**
```sh
composer install
npm install
```

### 🔹 **3. Cấu hình môi trường**
```sh
cp .env.example .env
php artisan key:generate
```
- **Chỉnh sửa file `.env`** để kết nối với database nếu cần.

### 🔹 **4. Chạy Migration**
```sh
php artisan migrate
```

### 🔹 **5. Chạy dự án**
```sh
php artisan serve
```
Truy cập vào trình duyệt: [http://127.0.0.1:8000/courses](http://127.0.0.1:8000/courses)

---

## 📌 **Hướng Dẫn Sử Dụng**
- **Thêm Khóa Học**: Nhấn vào nút "Thêm Khóa Học", nhập thông tin khóa học và nhấn "Lưu".
- **Sửa Khóa Học**: Nhấn vào nút "Sửa", chỉnh sửa thông tin và lưu lại.
- **Xóa Khóa Học**: Nhấn vào nút "Xóa", xác nhận và khóa học sẽ bị xóa.

---

## 📚 **Cấu Trúc Thư Mục**
```
📆 course-management
 ├📺 app/Http/Controllers/      # Controllers (CourseController.php)
 ├📺 app/Models/                # Models (Course.php)
 ├📺 resources/views/           # Giao diện (index.blade.php)
 ├📺 routes/                    # Cấu hình routes (web.php)
 ├📚 .env.example               # File mẫu cấu hình môi trường
 ├📚 composer.json              # Thư viện PHP sử dụng
 ├📚 package.json               # Thư viện frontend sử dụng
 └📚 README.md                  # Hướng dẫn sử dụng
```

---

## 🚒 **Cách Đẩy Code Lên GitHub**
1. **Thêm code mới**:
```sh
git add .
git commit -m "Cập nhật tính năng mới"
git push origin main
```

2. **Nếu gặp lỗi khi push**:
```sh
git pull --rebase origin main
git push origin main
```

---

## 📩 **Liên Hệ & Đóng Góp**
Nếu bạn muốn đóng góp hoặc báo lỗi, hãy tạo một **Issue** hoặc **Pull Request** tại đây:  
🔗 [GitHub Repo](https://github.com/MowX204/btl_web_nang_cao)

---

🚀 **Chúc bạn code vui vẻ!** ✨

