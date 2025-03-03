@extends('layouts.app')

@section('title', 'Chỉnh Sửa Khóa Học')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">✏️ Chỉnh Sửa Khóa Học</h2>

    <div class="card shadow-sm p-4">
        <form action="{{ route('courses.update', $course->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">📖 Tiêu đề</label>
                <input type="text" name="title" class="form-control" value="{{ $course->title }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">📝 Mô tả</label>
                <textarea name="description" class="form-control">{{ $course->description }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">👨‍🏫 Giảng viên</label>
                <input type="text" name="instructor_name" class="form-control" value="{{ $course->instructor_name }}" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Cập Nhật</button>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary w-100 mt-2">Hủy</a>
        </form>
    </div>
</div>
@endsection
