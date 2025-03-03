@extends('layouts.app')

@section('title', 'Chỉnh sửa Học Viên')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">✏ Chỉnh Sửa Học Viên</h2>

    <div class="card shadow-sm p-4">
        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">👨‍🎓 Họ Tên</label>
                <input type="text" class="form-control" name="name" value="{{ $student->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">📧 Email</label>
                <input type="email" class="form-control" name="email" value="{{ $student->email }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">📞 Số Điện Thoại</label>
                <input type="text" class="form-control" name="phone" value="{{ $student->phone }}">
            </div>

            <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary w-100 mt-2">Hủy</a>
        </form>
    </div>
</div>
@endsection
