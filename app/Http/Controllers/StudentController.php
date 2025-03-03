<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Hiển thị danh sách học viên
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    // Hiển thị form thêm học viên mới
    public function create()
    {
        return view('students.create');
    }

    // Lưu học viên mới vào database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students',
            'phone' => 'nullable|string|max:20',
        ]);

        Student::create($request->all());

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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Thông tin học viên đã được cập nhật!');
    }

    // Xóa học viên
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Học viên đã bị xóa!');
    }
}

