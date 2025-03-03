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
                                <button type="button" class="btn btn-warning btn-sm edit-button" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editStudentModal"
                                    data-id="{{ $student->id }}"
                                    data-name="{{ $student->name }}"
                                    data-email="{{ $student->email }}"
                                    data-phone="{{ $student->phone }}">
                                    ✏️ Sửa
                                </button>

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
@endsection
