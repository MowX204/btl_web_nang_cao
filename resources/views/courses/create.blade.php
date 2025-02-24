@extends('layouts.app')

@section('title', 'Thêm Khóa Học')

@section('content')
    <div class="container">
        <h1>Thêm Khóa Học</h1>
        <form action="{{ route('courses.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Tên Khóa Học</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mô Tả</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Tên Giảng Viên</label>
                <input type="text" name="instructor_name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
