<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;

class EnrollmentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $courses = Course::all();
        return view('enrollment', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        Enrollment::create($request->all());
        return redirect()->route('enroll.index')->with('success', 'Đăng ký khóa học thành công');
    }
}
