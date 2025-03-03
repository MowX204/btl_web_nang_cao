<?php

namespace App\Http\Controllers;
use App\Models\Course; 


use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Hiển thị danh sách học viên
    public function index()
    {
        $students = Student::all();
        $courses = Course::all(); // Lấy tất cả các khóa học
        return view('students.index', compact('students', 'courses'));
    }


    // Hiển thị form thêm học viên mới
    public function create()
    {
        return view('students.create');
    }

    // Lưu học viên mới vào database
    public function store(Request $request)
    {
        // Validate dữ liệu nhập vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'nullable|string|max:20', // Phone có thể để trống
        ]);

        // Lưu học viên mới vào database
        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,  // Lưu số điện thoại nếu có
        ]);

        return redirect()->route('students.index')->with('success', 'Học viên đã được thêm thành công!');
    }


    // Hiển thị form chỉnh sửa học viên
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // Cập nhật thông tin học viên
    public function update(Request $request, Student $student)
    {
        // Validate dữ liệu nhập vào, loại trừ email của học viên hiện tại
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id, // Loại trừ email hiện tại
            'phone' => 'nullable|string|max:20', // Phone có thể để trống
        ]);

        // Cập nhật thông tin học viên
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,  // Cập nhật số điện thoại nếu có
        ]);

        return redirect()->route('students.index')->with('success', 'Thông tin học viên đã được cập nhật!');
    }


    // Xóa học viên
    public function destroy(Student $student)
    {
        // Xóa học viên khỏi cơ sở dữ liệu
        $student->delete();

        // Quay lại danh sách học viên với thông báo thành công
        return redirect()->route('students.index')->with('success', 'Học viên đã bị xóa!');
    }
    // Trong StudentController
    public function assignCourse(Request $request) {
        $student = Student::findOrFail($request->student_id);
        $course = Course::findOrFail($request->course_id);
        $student->courses()->attach($course);
        return response()->json(['success' => true, 'course' => $course]);
    }

    
    public function removeCourse(Student $student, Course $course) {
        $student->courses()->detach($course);
        return response()->json(['success' => true]);
    }

    

}
