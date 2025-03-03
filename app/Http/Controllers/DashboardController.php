<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;

class DashboardController extends Controller
{
    public function index()
    {
        $students = Student::with('courses')->get();
        $courses = Course::all();
        return view('dashboard', compact('students', 'courses'));
    }
}
