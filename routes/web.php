<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Password;

// 🚀 Chuyển hướng trang chủ đến trang login nếu chưa đăng nhập, nếu đã đăng nhập thì vào dashboard
Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Nhóm quản lý khóa học
Route::middleware(['auth'])->prefix('courses')->name('courses.')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('index');
    Route::get('/create', [CourseController::class, 'create'])->name('create');
    Route::post('/', [CourseController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [CourseController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CourseController::class, 'update'])->name('update');
    Route::delete('/{id}', [CourseController::class, 'destroy'])->name('destroy');
});

// Nhóm quản lý học viên (chỉ cho phép truy cập khi đã đăng nhập)
Route::middleware(['auth'])->resource('students', StudentController::class);

// Nhóm quản lý ghi danh
Route::middleware(['auth'])->prefix('enroll')->name('enroll.')->group(function () {
    Route::get('/', [EnrollmentController::class, 'index'])->name('index');
    Route::post('/', [EnrollmentController::class, 'store'])->name('store');
});

// Báo cáo & Thống kê (yêu cầu đăng nhập)
Route::middleware(['auth'])->get('/reports', [ReportController::class, 'index'])->name('reports.index');

// Bảng điều khiển (yêu cầu đăng nhập)
Route::middleware(['auth'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ✅ Đăng xuất
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ Đăng nhập & Đăng ký
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Thêm route cho yêu cầu mật khẩu
Route::get('password/request', [AuthController::class, 'showPasswordRequestForm'])->name('password.request');
Route::post('password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

// Route để reset mật khẩu
Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'reset'])->name('password.update');


Route::post('/students/assign-course', [StudentController::class, 'assignCourse'])->name('students.assignCourse');


// Xóa khóa học của học viên
Route::delete('/students/{student}/courses/{course}', [StudentController::class, 'removeCourse'])
->name('students.removeCourse');

Route::post('/students/assign-course', [StudentController::class, 'assignCourse'])->name('students.assignCourse');
Route::delete('/students/{student}/courses/{course}', [StudentController::class, 'removeCourse'])->name('students.removeCourse');


