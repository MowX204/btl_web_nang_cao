@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chọn Khóa Học</h2>

    <form action="{{ route('enroll.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="student_id" class="form-label">Chọn Học viên</label>
            <select class="form-control" name="student_id" required>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="course_id" class="form-label">Chọn Khóa Học</label>
            <select class="form-control" name="course_id" required>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Đăng ký</button>
    </form>
</div>
@endsection
