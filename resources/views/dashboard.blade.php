@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Quản lý Học viên & Đăng Ký Khóa học</h2>

    <!-- Danh sách học viên -->
    <div class="card">
        <div class="card-header">Danh sách Học viên</div>
        <div class="card-body">
            <table class="table table-bordered" id="studentsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Khóa học</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr id="student-{{ $student->id }}">
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            <ul id="courses-list-{{ $student->id }}">
                                @foreach ($student->courses as $course)
                                    <li id="course-{{ $course->id }}">
                                        {{ $course->title }}
                                        <!-- Nút Xóa Khóa học -->
                                        <button class="btn btn-sm btn-danger remove-course" 
                                                data-student="{{ $student->id }}" 
                                                data-course="{{ $course->id }}">
                                            ❌
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <!-- Form Đăng Ký Khóa học -->
                            <form class="assign-course-form" data-student="{{ $student->id }}">
                                @csrf
                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                <select name="course_id" class="form-select course-select" required>
                                    <option value="">Chọn khóa học</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm mt-2">Đăng Ký Khóa học</button>
                            </form>

                            <!-- Nút Xóa học viên -->
                            <button class="btn btn-danger btn-sm mt-2 delete-student" 
                                    data-student="{{ $student->id }}">
                                Xóa
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Xác nhận Xóa -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa học viên này?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Xóa</button>
            </div>
        </div>
    </div>
</div>

<!-- Import SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // Xử lý đăng ký khóa học bằng AJAX
    document.querySelectorAll(".assign-course-form").forEach(form => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            let studentId = this.dataset.student;
            let formData = new FormData(this);

            fetch("{{ route('students.assignCourse') }}", {
                method: "POST",
                body: formData,
                headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let courseList = document.querySelector("#courses-list-" + studentId);
                    let newCourse = document.createElement("li");
                    newCourse.id = "course-" + data.course.id;
                    newCourse.innerHTML = `
                        ${data.course.title}
                        <button class="btn btn-sm btn-danger remove-course" 
                                data-student="${studentId}" data-course="${data.course.id}">
                            ❌
                        </button>
                    `;
                    courseList.appendChild(newCourse);
                    Swal.fire("Thành công!", "Đã đăng ký khóa học.", "success");
                } else {
                    Swal.fire("Lỗi!", data.message, "error");
                }
            });
        });
    });

    // Xử lý xóa khóa học bằng AJAX
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-course")) {
            let studentId = event.target.dataset.student;
            let courseId = event.target.dataset.course;

            Swal.fire({
                title: "Bạn có chắc muốn xóa khóa học này?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Xóa",
                cancelButtonText: "Hủy"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/students/${studentId}/courses/${courseId}`, {
                        method: "DELETE",
                        headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.querySelector(`#course-${courseId}`).remove();
                            Swal.fire("Thành công!", "Đã xóa khóa học.", "success");
                        } else {
                            Swal.fire("Lỗi!", data.message, "error");
                        }
                    });
                }
            });
        }
    });

    // Xử lý xóa học viên với modal xác nhận
    let deleteStudentId = null;
    document.querySelectorAll(".delete-student").forEach(button => {
        button.addEventListener("click", function () {
            deleteStudentId = this.dataset.student;
            let modal = new bootstrap.Modal(document.getElementById("confirmDeleteModal"));
            modal.show();
        });
    });

    document.getElementById("confirmDelete").addEventListener("click", function () {
        fetch(`/students/${deleteStudentId}`, {
            method: "DELETE",
            headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector(`#student-${deleteStudentId}`).remove();
                Swal.fire("Thành công!", "Học viên đã bị xóa.", "success");
            } else {
                Swal.fire("Lỗi!", data.message, "error");
            }
        });
        let modal = bootstrap.Modal.getInstance(document.getElementById("confirmDeleteModal"));
        modal.hide();
    });

});
</script>
@endsection
