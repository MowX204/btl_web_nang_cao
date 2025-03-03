@extends('layouts.app')

@section('title', 'Danh sách Học Viên')

@section('content')
<div class="container">
    <div class="text-center mb-4">
        <h1 class="fw-bold"><img src="https://img.icons8.com/color/48/000000/students.png"/> Danh Sách Học Viên</h1>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#addStudentModal">
            <i class="fas fa-plus-circle"></i> Thêm Học Viên
        </button>
    </div>

    <div class="card shadow-lg">
        <div class="card-body">
            <table id="studentsTable" class="table table-hover table-bordered align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>👨‍🎓 Họ Tên</th>
                        <th>📧 Email</th>
                        <th>📞 Số Điện Thoại</th>
                        <th>📚 Khóa học</th>
                        <th>⚙️ Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr class="text-center">
                            <td><strong>{{ $student->id }}</strong></td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone ?? 'Chưa có số' }}</td>
                            <td>
                                @if($student->courses->count() > 0)
                                    <ul class="list-unstyled">
                                        @foreach ($student->courses as $course)
                                            <li>
                                                {{ $course->title }}
                                                <!-- Xóa khóa học -->
                                                <form action="{{ route('students.removeCourse', ['student' => $student->id, 'course' => $course->id]) }}" method="POST" class="d-inline remove-course-form">

                                                    
                                                    
                                                </form>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted">Chưa đăng ký khóa học</span>
                                @endif
                            </td>
                            <td>
                                <!-- Nút Sửa -->
                                <button type="button" class="btn btn-warning btn-sm edit-button" 
                                    data-id="{{ $student->id }}"
                                    data-name="{{ $student->name }}"
                                    data-email="{{ $student->email }}"
                                    data-phone="{{ $student->phone }}">
                                    ✏️ Sửa
                                </button>

                                <!-- Nút Xóa -->
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline delete-form" data-name="{{ $student->name }}">
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

<!-- Modal Thêm Học Viên -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Thêm Học Viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addStudentForm" action="{{ route('students.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">👨‍🎓 Họ Tên</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">📧 Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">📞 Số Điện Thoại</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Lưu</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sửa Học Viên -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStudentModalLabel">Sửa Học Viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editStudentForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">👨‍🎓 Họ Tên</label>
                        <input type="text" id="edit-name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">📧 Email</label>
                        <input type="email" id="edit-email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">📞 Số Điện Thoại</label>
                        <input type="text" id="edit-phone" name="phone" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Import SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- JavaScript -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Xử lý mở modal sửa
    document.querySelectorAll(".edit-button").forEach(button => {
        button.addEventListener("click", function () {
            let id = this.dataset.id;
            let name = this.dataset.name;
            let email = this.dataset.email;
            let phone = this.dataset.phone;

            document.getElementById("edit-name").value = name;
            document.getElementById("edit-email").value = email;
            document.getElementById("edit-phone").value = phone;
            document.getElementById("editStudentForm").setAttribute("action", "/students/" + id);

            let modal = new bootstrap.Modal(document.getElementById("editStudentModal"));
            modal.show();
        });
    });

    // Xác nhận xóa học viên
    document.querySelectorAll(".delete-button").forEach(button => {
        button.addEventListener("click", function () {
            let form = this.closest("form");
            Swal.fire({
                title: "Bạn có chắc muốn xóa?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Xóa",
                cancelButtonText: "Hủy"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>

@endsection
