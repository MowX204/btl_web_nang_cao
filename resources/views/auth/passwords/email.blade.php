<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
        }
        .auth-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        .auth-form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .auth-form h3 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="auth-container">
        <div class="auth-form">
            <h3>Quên mật khẩu</h3>

            <!-- Form Quên mật khẩu -->
            <form action="{{ route('password.email') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Nhập email để nhận liên kết đặt lại mật khẩu</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Nhập email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nút gửi yêu cầu -->
                <button type="submit" class="btn btn-primary btn-block">Gửi liên kết đặt lại mật khẩu</button>

                <!-- Đăng nhập nếu có tài khoản -->
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}">Đã có tài khoản? Đăng nhập ngay</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
