@extends('layouts.app')

@section('title', 'Chỉnh sửa Khóa Học')

@section('content')
    <div class="container">
        <h1>Chỉnh sửa Khóa Học</h1>
        <form action="{{ route('courses.update', $course->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Tên Khóa Học</label>
                <input type="text" name="title" class="form-control" value="{{ $course->title }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mô Tả</label>
                <textarea name="description" class="form-control">{{ $course->description }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Tên Giảng Viên</label>
                <input type="text" name="instructor_name" class="form-control" value="{{ $course->instructor_name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
