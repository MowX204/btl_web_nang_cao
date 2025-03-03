@extends('layouts.app')

@section('title', 'Danh sách Khóa Học')

@section('content')
<div class="container">
    <div class="text-center mb-4">
        <h1 class="fw-bold"><img src="https://img.icons8.com/color/48/000000/books.png"/> Danh Sách Khóa Học</h1>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#addCourseModal">
            <i class="fas fa-plus-circle"></i> Thêm Khóa Học
        </button>
    </div>

    <div class="card shadow-lg">
        <div class="card-body">
            <table id="coursesTable" class="table table-striped table-hover table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th><i class="fas fa-book"></i> Tiêu đề</th>
                        <th><i class="fas fa-pencil-alt"></i> Mô tả</th>
                        <th><i class="fas fa-chalkboard-teacher"></i> Giảng viên</th>
                        <th><i class="fas fa-cogs"></i> Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <td><strong>{{ $course->id }}</strong></td>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->description }}</td>
                            <td>{{ $course->instructor_name ?? 'Không có giảng viên' }}</td>
                            <td>
                                <!-- Nút Sửa -->
                                <button type="button" class="btn btn-warning btn-sm edit-button" 
                                    data-id="{{ $course->id }}"
                                    data-title="{{ $course->title }}"
                                    data-description="{{ $course->description }}"
                                    data-instructor="{{ $course->instructor_name }}">
                                    <i class="fas fa-edit"></i> Sửa
                                </button>

                                <!-- Nút Xóa -->
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-button" data-name="{{ $course->title }}">
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
                <h5 class="modal-title" id="addCourseModalLabel">Thêm Khóa Học</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm" action="{{ route('courses.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">📖 Tiêu đề</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">📝 Mô tả</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">👨‍🏫 Giảng viên</label>
                        <input type="text" name="instructor_name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Lưu</button>
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
                <h5 class="modal-title" id="editCourseModalLabel">Sửa Khóa Học</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCourseForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">📖 Tiêu đề</label>
                        <input type="text" id="edit-title" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">📝 Mô tả</label>
                        <textarea id="edit-description" name="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">👨‍🏫 Giảng viên</label>
                        <input type="text" id="edit-instructor" name="instructor_name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- JavaScript -->
<!-- Import SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Xử lý mở modal sửa
        document.querySelectorAll(".edit-button").forEach(button => {
            button.addEventListener("click", function () {
                let id = this.dataset.id;
                let title = this.dataset.title;
                let description = this.dataset.description;
                let instructor = this.dataset.instructor;
    
                // Kiểm tra nếu phần tử tồn tại trước khi thay đổi giá trị
                let editTitle = document.getElementById("edit-title");
                if (editTitle) {
                    editTitle.value = title;
                }
    
                let editDescription = document.getElementById("edit-description");
                if (editDescription) {
                    editDescription.value = description;
                }
    
                let editInstructor = document.getElementById("edit-instructor");
                if (editInstructor) {
                    editInstructor.value = instructor;
                }
    
                // Kiểm tra và cập nhật lại action của form
                let editCourseForm = document.getElementById("editCourseForm");
                if (editCourseForm) {
                    editCourseForm.setAttribute("action", "/courses/" + id);
                } else {
                    console.error("Không tìm thấy form 'editCourseForm'");
                }
    
                // Mở modal
                let modal = new bootstrap.Modal(document.getElementById("editCourseModal"));
                modal.show();
            });
        });
    
        // Xử lý Xóa với SweetAlert2
        document.querySelectorAll(".delete-button").forEach(button => {
            button.addEventListener("click", function () {
                let form = this.closest("form");
                let itemName = this.dataset.name;
    
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
                        form.submit(); // Gửi form để xóa
                    }
                });
            });
        });
    
        // Reset form khi mở modal thêm
        document.getElementById("addCourseModal").addEventListener("show.bs.modal", function () {
            let addForm = document.getElementById("addForm");
            if (addForm) {
                addForm.reset();
            }
        });
    });
    </script>
    
    

@endsection
