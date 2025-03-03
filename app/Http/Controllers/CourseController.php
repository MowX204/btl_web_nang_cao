<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    // Hiển thị danh sách khóa học
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    // Thêm khóa học mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructor_name' => 'required|string|max:255',
        ]);

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'instructor_name' => $request->instructor_name,
        ]);

        return redirect()->route('courses.index')->with('success', 'Khóa học đã được thêm!');
    }

    // Thêm khóa học mới (hiển thị form tạo khóa học)
    public function create()
    {
        return view('courses.create'); // Đảm bảo bạn có view 'courses.create'
    }

    // Trả về dữ liệu khóa học khi chỉnh sửa
    public function edit($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json(['error' => 'Khóa học không tồn tại!'], 404);
        }
        return response()->json($course);
    }

    // Cập nhật thông tin khóa học
    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        if (!$course) {
            return redirect()->route('courses.index')->with('error', 'Khóa học không tồn tại!');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructor_name' => 'required|string|max:255',
        ]);

        $course->update([
            'title' => $request->title,
            'description' => $request->description,
            'instructor_name' => $request->instructor_name,
        ]);

        return redirect()->route('courses.index')->with('success', 'Cập nhật khóa học thành công!');
    }

    // Xóa khóa học
    public function destroy($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return redirect()->route('courses.index')->with('error', 'Khóa học không tồn tại!');
        }

        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Khóa học đã được xóa!');
    }
}
