<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students', compact('students'));
    }

    public function create()
    {
        return view('students_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
        ]);

        Student::create($request->all());
        return redirect()->route('students.index')->with('success', 'Học viên được thêm thành công');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students_edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->all());
        return redirect()->route('students.index')->with('success', 'Thông tin học viên được cập nhật');
    }

    public function destroy($id)
    {
        Student::destroy($id);
        return redirect()->route('students.index')->with('success', 'Học viên đã bị xóa');
    }
}
