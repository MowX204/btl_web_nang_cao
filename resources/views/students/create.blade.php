@extends('layouts.app')

@section('title', 'Thêm Học Viên')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">➕ Thêm Học Viên</h2>

    <div class="card shadow-sm p-4">
        <form action="{{ route('students.store') }}" method="POST">
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
@endsection

