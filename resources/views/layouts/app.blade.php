<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Course Management') }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            padding-top: 60px;
        }
        .form-container {
            margin-top: 30px;
        }
        .table-container {
            margin-top: 20px;
        }
        .btn {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    @if(Route::currentRouteName() != 'register' && Route::currentRouteName() != 'login') 
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">📚 Quản lý khóa học</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            @if(Route::has('dashboard'))
                                <a class="nav-link" href="{{ route('dashboard') }}">📊 Dashboard</a>
                            @endif
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="courseMenu" role="button" data-bs-toggle="dropdown">
                                📚 Quản lý khóa học
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="courseMenu">
                                @if(Route::has('courses.index'))
                                    <li><a class="dropdown-item" href="{{ route('courses.index') }}">📋 Danh sách khóa học</a></li>
                                @endif
                                @if(Route::has('courses.create'))
                                    <li><a class="dropdown-item" href="{{ route('courses.create') }}">➕ Thêm mới khóa học</a></li>
                                @endif
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="studentMenu" role="button" data-bs-toggle="dropdown">
                                👩‍🎓 Quản lý học viên
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="studentMenu">
                                @if(Route::has('students.index'))
                                    <li><a class="dropdown-item" href="{{ route('students.index') }}">👥 Danh sách học viên</a></li>
                                @endif
                                @if(Route::has('students.create'))
                                    <li><a class="dropdown-item" href="{{ route('students.create') }}">➕ Thêm học viên mới</a></li>
                                @endif
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="reportMenu" role="button" data-bs-toggle="dropdown">
                                📊 Báo cáo & Thống kê
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="reportMenu">
                                @if(Route::has('reports.index'))
                                    <li><a class="dropdown-item" href="{{ route('reports.index') }}">📈 Thống kê khóa học</a></li>
                                @endif
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="settingsMenu" role="button" data-bs-toggle="dropdown">
                                ⚙️ Cài đặt
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="settingsMenu">
                                @if(Route::has('settings.index'))
                                    <li><a class="dropdown-item" href="{{ route('settings.index') }}">⚙️ Thiết lập hệ thống</a></li>
                                @endif
                                @if(Route::has('logout'))
                                    <li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">🚪 Đăng xuất</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    @endif

    <!-- Nội dung trang -->
    <div class="container form-container">
        @yield('content')
    </div>

    <!-- jQuery & Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        
        $(document).ready(function () {
            // Xác nhận xóa với SweetAlert2
            $(document).on("click", ".delete-button", function () {
                let form = $(this).closest("form");
                let itemName = form.data("name");

                Swal.fire({
                    title: "Bạn có chắc muốn xóa?",
                    text: "Bạn sắp xóa: " + itemName,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Xóa",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // Xử lý mở modal sửa
            $(document).on("click", ".edit-button", function () {
                let id = $(this).data("id");
                let name = $(this).data("name") || "";
                let email = $(this).data("email") || "";
                let phone = $(this).data("phone") || "";
                let title = $(this).data("title") || "";
                let description = $(this).data("description") || "";
                let instructor = $(this).data("instructor") || "";

                $("#edit-name").val(name);
                $("#edit-email").val(email);
                $("#edit-phone").val(phone);
                $("#edit-title").val(title);
                $("#edit-description").val(description);
                $("#edit-instructor").val(instructor);

                $("#editForm").attr("action", "/students/" + id);
                $("#editCourseForm").attr("action", "/courses/" + id);

                $("#editModal").modal("show");
            });

            // Reset form khi mở modal thêm
            $('#addModal').on('show.bs.modal', function () {
                $("#addForm").trigger("reset");
            });

            // Đảm bảo menu hoạt động sau khi đóng modal
            $('.modal').on('hidden.bs.modal', function () {
                $('.navbar-collapse').removeClass('show');
            });

            // Đóng dropdown khi click ra ngoài
            $(document).click(function (event) {
                if (!$(event.target).closest('.dropdown-toggle, .dropdown-menu').length) {
                    $('.dropdown-menu').removeClass('show');
                }
            });
        });
    </script>
</body>
</html>
