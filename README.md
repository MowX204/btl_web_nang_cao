## 🎓 **Quản Lý Khóa Học**

> Dự án **Quản Lý Khóa Học** được xây dựng bằng Laravel, giúp quản lý các khóa học với các chức năng thêm, sửa, xóa và tìm kiếm.

## 📌 **Sơ Đồ Chức Năng**

```plaintext
          ┌──────────────────┐
          │    Quản lý      │
          │    Khóa Học     │
          └──────────────────┘
                 │
    ┌────────────────────────┐
    │  Thêm Khóa Học        │
    └────────────────────────┘
                 │
    ┌────────────────────────┐
    │  Sửa Khóa Học         │
    └────────────────────────┘
                 │
    ┌────────────────────────┐
    │  Xóa Khóa Học         │
    └────────────────────────┘
                 │
    ┌────────────────────────┐
    │ Quản lý Học Viên      │
    └────────────────────────┘
                 │
    ┌────────────────────────┐
    │ Thêm, Sửa, Xóa Học Viên│
    └────────────────────────┘
                 │
    ┌────────────────────────┐
    │ Quản lý Giao Dịch      │
    └────────────────────────┘

---

## 📌 **Tính Năng Chính**
👉 Quản lý danh sách khóa học
👉 Thêm, sửa, xóa khóa học
👉 Quản lý danh sách học viên
👉 Quản lý giao dịch đăng ký khóa học
👉 Giao diện đẹp, hiện đại với Bootstrap
👉 Xác nhận khi xóa khóa học bằng SweetAlert
👉 Tự động chuyển hướng từ / sang /courses

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

### **1. Thêm Khóa Học**
- Nhấn vào nút **"Thêm Khóa Học"** trên giao diện quản lý khóa học.
- Nhập thông tin khóa học cần thêm vào hệ thống (tên khóa học, mô tả, v.v.).
- Nhấn **"Lưu"** để lưu khóa học mới.

### **2. Sửa Khóa Học**
- Trên danh sách các khóa học, nhấn vào nút **"Sửa"** của khóa học bạn muốn chỉnh sửa.
- Cập nhật thông tin khóa học cần thay đổi.
- Nhấn **"Lưu"** để cập nhật thông tin khóa học.

### **3. Xóa Khóa Học**
- Trên danh sách các khóa học, nhấn vào nút **"Xóa"** của khóa học bạn muốn xóa.
- Xác nhận lại hành động xóa trong cửa sổ thông báo **SweetAlert**.
- Khóa học sẽ bị xóa khỏi hệ thống nếu bạn xác nhận.

### **4. Thêm Học Viên**
- Quản trị viên có thể thêm học viên mới vào hệ thống bằng cách vào giao diện quản lý học viên.
- Nhấn vào nút **"Thêm Học Viên"**, nhập thông tin học viên (tên, email, số điện thoại, v.v.).
- Nhấn **"Lưu"** để thêm học viên vào hệ thống.

### **5. Sửa Học Viên**
- Quản trị viên có thể sửa thông tin học viên đã có trong hệ thống.
- Nhấn vào nút **"Sửa"** của học viên cần chỉnh sửa.
- Cập nhật thông tin cần thay đổi và nhấn **"Cập nhật"**.

### **6. Xóa Học Viên**
- Quản trị viên có thể xóa học viên khỏi hệ thống.
- Nhấn vào nút **"Xóa"** của học viên cần xóa.
- Xác nhận lại hành động xóa trong cửa sổ thông báo **SweetAlert**.

### **7. Quản Lý Giao Dịch**
- Quản trị viên có thể quản lý giao dịch mượn khóa học.
- Các giao dịch sẽ được hiển thị trong danh sách giao dịch, bao gồm thông tin học viên và khóa học mượn.
- Quản trị viên có thể thêm giao dịch mới và đánh dấu giao dịch là đã hoàn thành.

---

Chúc bạn sử dụng ứng dụng thành công!


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

