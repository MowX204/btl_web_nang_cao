@extends('layouts.app')

@section('title', 'Chỉnh Sửa Học Viên')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">✏️ Chỉnh Sửa Học Viên</h2>

    <div class="card shadow-sm p-4">
        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">👨‍🎓 Họ Tên</label>
                <input type="text" name="name" class="form-control" value="{{ $student->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">📧 Email</label>
                <input type="email" name="email" class="form-control" value="{{ $student->email }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">📞 Số Điện Thoại</label>
                <input type="text" name="phone" class="form-control" value="{{ $student->phone }}">
            </div>
            <button type="submit" class="btn btn-success w-100">Cập nhật</button>
        </form>
    </div>
</div>
@endsection
