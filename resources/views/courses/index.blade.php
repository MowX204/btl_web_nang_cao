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
                                <!-- Nút Sửa -->
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
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline delete-form" data-name="{{ $course->title }}">
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

<!-- JavaScript -->
<script>
$(document).ready(function () {
    $('#coursesTable').DataTable();

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
        let title = $(this).data("title");
        let description = $(this).data("description");
        let instructor = $(this).data("instructor");

        $("#edit-title").val(title);
        $("#edit-description").val(description);
        $("#edit-instructor").val(instructor);
        $("#editCourseForm").attr("action", "/courses/" + id);

        $("#editCourseModal").modal("show");
    });

    // Reset form khi mở modal thêm
    $('#addCourseModal').on('show.bs.modal', function () {
        $("#addForm").trigger("reset");
    });

    // Đảm bảo menu hoạt động sau khi đóng modal
    $('.modal').on('hidden.bs.modal', function () {
        $('.navbar-collapse').removeClass('show');
    });

    // Sửa lỗi menu không mở được sau khi modal đóng
    $('.navbar-toggler').click(function () {
        setTimeout(function () {
            $('.navbar-collapse').addClass('show');
        }, 300);
    });
});
</script>
@endsection
