<?php

namespace App\Http\Controllers; // 🔥 Thêm namespace

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password; // Thêm dòng này
use App\Http\Controllers\Controller;


class AuthController extends Controller // 🔥 Đúng namespace
{
    public function showLoginForm()
    {
        return view('auth.login'); // Đảm bảo file login.blade.php tồn tại
    }

    public function showRegisterForm()
    {
        return view('auth.register'); // Đảm bảo file register.blade.php tồn tại
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']) // Bắt buộc mã hóa mật khẩu
        ]);

        Auth::login($user); // Tự động đăng nhập sau khi đăng ký

        // Sau khi đăng ký thành công, chuyển hướng đến trang đăng nhập
        return redirect()->route('login')->with('success', 'Đăng ký thành công! Bạn có thể đăng nhập ngay bây giờ.');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác']);
    }

    public function showPasswordRequestForm()
    {
        return view('auth.passwords.email');  // Đây là view để gửi link yêu cầu mật khẩu
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Gửi link reset mật khẩu
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withErrors(['email' => 'Không thể tìm thấy email này.']);
    }
    // Hiển thị form nhập mật khẩu mới
    public function showResetForm($token)
    {
        return view('auth.passwords.reset', compact('token'));
    }
    // Xử lý cập nhật mật khẩu mới
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->password = Hash::make($request->password);
                $user->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Mật khẩu đã được thay đổi thành công!');
        }

        return back()->withErrors(['email' => [__($status)]]);
    }
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email'); // Đây là view hiển thị form để người dùng nhập email
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Bạn đã đăng xuất!');
    }

}