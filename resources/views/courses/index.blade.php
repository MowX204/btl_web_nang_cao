@extends('layouts.app')

@section('title', 'Danh sách Khóa học')

@section('content')
<div class="container">
    <div class="text-center mb-4">
        <h1 class="fw-bold"><img src="https://img.icons8.com/color/48/000000/books.png"/> Danh Sách Khóa Học</h1>
    </div>

    <!-- Nút mở modal để thêm khóa học -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#addCourseModal">
            <i class="fas fa-plus-circle"></i> Thêm Khóa Học
        </button>
    </div>

    <div class="card shadow-lg">
        <div class="card-body">
            <table id="coursesTable" class="table table-hover table-bordered align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>📖 Tiêu đề</th>
                        <th>📝 Mô tả</th>
                        <th>👨‍🏫 Giảng viên</th>
                        <th>⚙️ Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr class="text-center">
                            <td><strong>{{ $course->id }}</strong></td>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->description }}</td>
                            <td>{{ $course->instructor_name ? $course->instructor_name : 'Không có giảng viên' }}</td>
                            <td>
                                <!-- Nút Sửa (Mở modal sửa khóa học) -->
                                <button type="button" class="btn btn-warning btn-sm edit-button" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editCourseModal"
                                    data-id="{{ $course->id }}"
                                    data-title="{{ $course->title }}"
                                    data-description="{{ $course->description }}"
                                    data-instructor="{{ $course->instructor_name }}">
                                    ✏️ Sửa
                                </button>

                                <!-- Nút Xóa -->
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline delete-form" data-title="{{ $course->title }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-button">
                                        <i class="fas fa-trash-alt"></i> Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Thêm Khóa Học -->
<div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">➕ Thêm Khóa Học</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('courses.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">📖 Tên Khóa Học</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">📝 Mô Tả</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">👨‍🏫 Tên Giảng Viên</label>
                        <input type="text" name="instructor_name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sửa Khóa Học -->
<div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="editCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">✏️ Chỉnh sửa Khóa Học</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editCourseForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">📖 Tên Khóa Học</label>
                        <input type="text" id="edit-title" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">📝 Mô Tả</label>
                        <textarea id="edit-description" name="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">👨‍🏫 Tên Giảng Viên</label>
                        <input type="text" id="edit-instructor" name="instructor_name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Cập Nhật</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Thư viện Bootstrap, FontAwesome, DataTables & SweetAlert -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {
    $('#coursesTable').DataTable();

    // Xác nhận xóa bằng SweetAlert
    $(document).on("click", ".delete-button", function () {
        let form = $(this).closest("form");
        let courseTitle = form.data("title");

        Swal.fire({
            title: "Bạn có chắc muốn xóa?",
            text: "Bạn sắp xóa khóa học: " + courseTitle,
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

    // Xử lý mở modal sửa khóa học
    $(document).on("click", ".edit-button", function () {
        let id = $(this).data("id");
        let title = $(this).data("title");
        let description = $(this).data("description");
        let instructor = $(this).data("instructor");

        $("#edit-title").val(title);
        $("#edit-description").val(description);
        $("#edit-instructor").val(instructor);
        $("#editCourseForm").attr("action", "/courses/" + id);

        $("#editCourseModal").modal("show");
    });
});
</script>
@endsection
