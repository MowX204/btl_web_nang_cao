@extends('layouts.app')

@section('title', 'Thêm Khóa Học')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">➕ Thêm Khóa Học</h2>

    <div class="card shadow-sm p-4">
        <form action="{{ route('courses.store') }}" method="POST">
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
            <a href="{{ route('courses.index') }}" class="btn btn-secondary w-100 mt-2">Hủy</a>
        </form>
    </div>
</div>
@endsection
