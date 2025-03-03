<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">📚 Quản lý khóa học</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                @if(Route::has('dashboard'))
                    <a class="nav-link" href="{{ route('dashboard') }}">📊 Dashboard</a>
                @endif
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="courseMenu" data-toggle="dropdown">📚 Quản lý khóa học</a>
                <div class="dropdown-menu">
                    @if(Route::has('courses.index'))
                        <a class="dropdown-item" href="{{ route('courses.index') }}">📋 Danh sách khóa học</a>
                    @endif
                    @if(Route::has('courses.create'))
                        <a class="dropdown-item" href="{{ route('courses.create') }}">➕ Thêm mới khóa học</a>
                    @endif
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="studentMenu" data-toggle="dropdown">👩‍🎓 Quản lý học viên</a>
                <div class="dropdown-menu">
                    @if(Route::has('students.index'))
                        <a class="dropdown-item" href="{{ route('students.index') }}">👥 Danh sách học viên</a>
                    @endif
                    @if(Route::has('students.create'))
                        <a class="dropdown-item" href="{{ route('students.create') }}">➕ Thêm học viên mới</a>
                    @endif
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="reportMenu" data-toggle="dropdown">📊 Báo cáo & Thống kê</a>
                <div class="dropdown-menu">
                    @if(Route::has('reports.index'))
                        <a class="dropdown-item" href="{{ route('reports.index') }}">📈 Thống kê khóa học</a>
                    @endif
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="settingsMenu" data-toggle="dropdown">⚙️ Cài đặt</a>
                <div class="dropdown-menu">
                    @if(Route::has('settings.index'))
                        <a class="dropdown-item" href="{{ route('settings.index') }}">⚙️ Thiết lập hệ thống</a>
                    @endif
                    @if(Route::has('logout'))
                        <!-- Logout Form -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">🚪 Đăng xuất</a>
                    @endif
                </div>
            </li>
        </ul>
    </div>
</nav>
