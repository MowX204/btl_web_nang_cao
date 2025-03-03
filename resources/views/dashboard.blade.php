@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Quản lý Học viên & Đăng ký Khóa học</h2>

    <!-- Thêm học viên -->
    <div class="card mb-4">
        <div class="card-header">Thêm Học viên</div>
        <div class="card-body">
            <form action="{{ route('students.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Tên Học viên</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <button type="submit" class="btn btn-success">Thêm Học viên</button>
            </form>
        </div>
    </div>

    <!-- Danh sách học viên -->
    <div class="card">
        <div class="card-header">Danh sách Học viên</div>
        <div class="card-body">
            <table class="table table-bordered">
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
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            @if($student->courses->count() > 0)
                                <ul>
                                    @foreach ($student->courses as $course)
                                        <li>{{ $course->title }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">Chưa đăng ký</span>
                            @endif
                        </td>
                        <td>
                            <!-- Form đăng ký khóa học -->
                            <form action="{{ route('enroll.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                <select name="course_id" class="form-select" required>
                                    <option value="">Chọn khóa học</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm mt-2">Đăng ký</button>
                            </form>
                            
                            <!-- Xóa học viên -->
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mt-2">Xóa</button>
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
