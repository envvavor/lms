<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LMS - Learning Management System')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        // Immediately apply sidebar state to prevent flash
        (function() {
            const savedState = localStorage.getItem('sidebarState');
            if (savedState === 'collapsed') {
                document.documentElement.classList.add('sidebar-collapsed');
            }
        })();
    </script>
    
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-dark: #3730a3;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #3b82f6;
            --light-bg: #f8fafc;
            --dark-bg: #1e293b;
            --border-color: #e2e8f0;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        html, body {
            background-color: var(--light-bg);
            color: var(--text-primary);
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background-color: #2b2738;
            box-shadow: var(--shadow-lg);
            z-index: 1000;
            transform: translateX(0);
            transition: all 0.3s ease;
        }

        /* Prevent transitions during initial load to eliminate flash */
        .sidebar-collapsed .sidebar {
            transition: none;
        }
        .sidebar-collapsed .main-wrapper {
            transition: none;
        }

        /* Re-enable transitions after initial load */
        .sidebar.transition-enabled {
            transition: all 0.3s ease;
        }
        .main-wrapper.transition-enabled {
            transition: all 0.3s ease;
        }

        /* Immediately apply collapsed state to prevent flash */
        .sidebar-collapsed .sidebar {
            width: var(--sidebar-collapsed-width);
        }
        .sidebar-collapsed .main-wrapper {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Regular collapsed state for dynamic changes */
        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }
        .main-wrapper.collapsed {
            margin-left: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .sidebar-brand {
            font-weight: 700;
            font-size: 1.25rem;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .sidebar-brand .brand-text {
            display: none;
        }

        .sidebar-brand i {
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .sidebar-nav {
            padding: 1rem 0;
            list-style: none;
            margin: 0;
        }

        .nav-item {
            margin-bottom: 0.25rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            gap: 0.75rem;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background-color: white;
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar.collapsed .nav-link .nav-text {
            display: none;
        }

        .sidebar.collapsed .nav-link {
            padding: 0.75rem;
            justify-content: center;
        }

        /* Immediately hide text elements when collapsed to prevent flash */
        .sidebar-collapsed .sidebar .nav-link .nav-text {
            display: none;
        }

        .sidebar-collapsed .sidebar .nav-link {
            padding: 0.75rem;
            justify-content: center;
        }

        .sidebar-collapsed .sidebar .sidebar-brand .brand-text {
            display: none;
        }

        .sidebar-collapsed .sidebar .user-details {
            display: none;
        }

        .sidebar-collapsed .sidebar .user-info {
            justify-content: center;
            padding: 1rem;
        }

        /* User Section */
        .sidebar-user {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background-color: rgba(0, 0, 0, 0.1);
        }

        .user-dropdown {
            position: relative;
        }

        .user-info {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: white;
            gap: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-info:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            flex-shrink: 0;
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .role-badge {
            font-size: 0.7rem;
            padding: 0.125rem 0.375rem;
            border-radius: 0.25rem;
            font-weight: 500;
            margin-top: 0.125rem;
            display: inline-block;
        }

        .role-badge.admin { background-color: var(--danger-color); }
        .role-badge.teacher { background-color: var(--warning-color); }
        .role-badge.user { background-color: var(--info-color); }

        .sidebar.collapsed .user-details {
            display: none;
        }

        .sidebar.collapsed .user-info {
            justify-content: center;
            padding: 1rem;
        }

        /* User Dropdown Menu */
        .user-dropdown-menu {
            position: absolute;
            bottom: 100%;
            left: 0;
            right: 0;
            background: white;
            border-radius: 0.5rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            padding: 0.5rem 0;
            margin-bottom: 0.5rem;
            display: none;
            z-index: 99999;
            min-width: 200px;
        }

        .user-dropdown-menu.show {
            display: block;
        }

        .user-dropdown-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.3s ease;
            gap: 0.75rem;
        }

        .user-dropdown-item:hover {
            background-color: var(--light-bg);
            color: var(--text-primary);
        }

        .user-dropdown-item i {
            width: 16px;
            text-align: center;
            flex-shrink: 0;
        }

        .user-dropdown-divider {
            height: 1px;
            background-color: var(--border-color);
            margin: 0.5rem 0;
        }

        .dropdown-chevron {
            transition: transform 0.3s ease;
        }

        .user-dropdown.show .dropdown-chevron {
            transform: rotate(180deg);
        }

        /* Main Content */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
            min-height: 100vh;
        }

        .main-wrapper.collapsed {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Top Bar */
        .top-bar {
            background: white;
            padding: 1rem 1.5rem;
            box-shadow: var(--shadow-sm);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.25rem;
            color: var(--text-primary);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            background-color: var(--light-bg);
        }

        /* Mobile Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        /* Content Area */
        .main-content {
            padding: 0;
            color: var(--text-primary);
        }

        .page-header {
            background: white;
            padding: 2rem 1.5rem;
            margin: 0;
            box-shadow: var(--shadow-sm);
            border-bottom: 1px solid var(--border-color);
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        .content-wrapper {
            padding: 2rem 1.5rem;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            overflow: hidden;
            color: var(--text-primary);
        }

        .card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .card-header {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
            color: var(--text-primary);
        }

        .btn {
            border-radius: 0.5rem;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-overlay.show {
                display: block;
            }

            .main-wrapper {
                margin-left: 0;
            }

            .main-wrapper.collapsed {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: block;
            }

            .page-header {
                padding: 1.5rem 1rem;
            }

            .content-wrapper {
                padding: 1.5rem 1rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .top-bar {
                padding: 1rem;
            }
        }

        @media (max-width: 576px) {
            .page-header {
                padding: 1rem 0.75rem;
            }

            .content-wrapper {
                padding: 1rem 0.75rem;
            }

            .page-title {
                font-size: 1.25rem;
            }

            .top-bar {
                padding: 0.75rem;
            }

            .card-body {
                padding: 1rem;
            }
        }

        /* Desktop hover effects */
        @media (min-width: 769px) {
            .sidebar:not(.collapsed) .nav-link:hover .nav-text {
                transform: translateX(4px);
            }

            .nav-link .nav-text {
                transition: transform 0.3s ease;
            }
        }
    </style>
</head>
<body>
    @auth
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <!-- Sidebar Header -->
        <div class="sidebar-header">
            <a href="{{ route('courses.index') }}" class="sidebar-brand">
                <i class="fa-brands fa-google"></i>
                <span class="brand-text">Creativy LMS</span>
            </a>
        </div>

        <!-- Sidebar Navigation -->
        <ul class="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}" href="{{ route('courses.index') }}">
                    <i class="fas fa-book"></i>
                    <span class="nav-text">Courses</span>
                </a>
            </li>

            @if(Auth::user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                        <i class="fas fa-users"></i>
                        <span class="nav-text">Users</span>
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-chart-bar"></i>
                    <span class="nav-text">Analytics</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-cog"></i>
                    <span class="nav-text">Settings</span>
                </a>
            </li>
        </ul>

        <!-- User Section -->
        <div class="sidebar-user">
            <div class="user-dropdown" id="userDropdown">
                <div class="user-info" onclick="toggleUserDropdown()">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <span class="role-badge {{ Auth::user()->role }}">
                            {{ ucfirst(Auth::user()->role) }}
                        </span>
                    </div>
                    <i class="fas fa-chevron-up dropdown-chevron" style="font-size: 0.8rem; opacity: 0.7;"></i>
                </div>
                <div class="user-dropdown-menu" id="userDropdownMenu">
                    <a class="user-dropdown-item" href="#">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                    <a class="user-dropdown-item" href="#">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                    <div class="user-dropdown-divider"></div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="user-dropdown-item text-danger" href="#" id="logout-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- Main Content Wrapper -->
    <div class="main-wrapper" id="mainWrapper">
        <!-- Top Bar -->
        <div class="top-bar">
            <button class="sidebar-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted">Welcome back, {{ Auth::user()->name }}</span>
            </div>
        </div>

        <!-- Main Content -->
        <main class="main-content">
            {{-- SweetAlert for success --}}
            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: '{{ session('success') }}',
                            confirmButtonColor: '#4f46e5'
                        });
                    });
                </script>
            @endif

            {{-- SweetAlert for error --}}
            @if(session('error'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: '{{ session('error') }}',
                            confirmButtonColor: '#ef4444'
                        });
                    });
                </script>
            @endif

            @yield('content')
        </main>
    </div>
    @endauth

    @guest
    <!-- For guest users, show content without sidebar -->
    <main class="main-content">
        @yield('content')
    </main>
    @endguest

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Sidebar functionality
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainWrapper = document.getElementById('mainWrapper');
            const overlay = document.getElementById('sidebarOverlay');

            if (window.innerWidth <= 768) {
                // Mobile: Show/hide sidebar with overlay
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            } else {
                // Desktop: Collapse/expand sidebar
                sidebar.classList.toggle('collapsed');
                mainWrapper.classList.toggle('collapsed');

                // Save state to localStorage
                if (sidebar.classList.contains('collapsed')) {
                    localStorage.setItem('sidebarState', 'collapsed');
                    document.documentElement.classList.add('sidebar-collapsed');
                } else {
                    localStorage.setItem('sidebarState', 'expanded');
                    document.documentElement.classList.remove('sidebar-collapsed');
                }
            }
        }

        // User dropdown functionality
        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdown');
            const dropdownMenu = document.getElementById('userDropdownMenu');
            
            if (dropdown && dropdownMenu) {
                dropdown.classList.toggle('show');
                dropdownMenu.classList.toggle('show');
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            const userDropdown = document.getElementById('userDropdown');
            const dropdownMenu = document.getElementById('userDropdownMenu');
            
            if (userDropdown && dropdownMenu && !userDropdown.contains(event.target)) {
                userDropdown.classList.remove('show');
                dropdownMenu.classList.remove('show');
            }
        });

        // Close dropdown when pressing Escape key
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                const userDropdown = document.getElementById('userDropdown');
                const dropdownMenu = document.getElementById('userDropdownMenu');
                
                if (userDropdown && dropdownMenu) {
                    userDropdown.classList.remove('show');
                    dropdownMenu.classList.remove('show');
                }
            }
        });

        // Apply saved sidebar state on page load
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const mainWrapper = document.getElementById('mainWrapper');
            const savedState = localStorage.getItem('sidebarState');

            if (window.innerWidth > 768) {
                if (savedState === 'collapsed') {
                    sidebar.classList.add('collapsed');
                    mainWrapper.classList.add('collapsed');
                    document.documentElement.classList.add('sidebar-collapsed');
                } else {
                    sidebar.classList.remove('collapsed');
                    mainWrapper.classList.remove('collapsed');
                    document.documentElement.classList.remove('sidebar-collapsed');
                }
            } else {
                sidebar.classList.remove('collapsed');
                mainWrapper.classList.remove('collapsed');
                document.documentElement.classList.remove('sidebar-collapsed');
            }
        });

        // Function to apply sidebar state immediately
        function applySidebarState() {
            const sidebar = document.getElementById('sidebar');
            const mainWrapper = document.getElementById('mainWrapper');
            const savedState = localStorage.getItem('sidebarState');

            if (window.innerWidth > 768 && savedState === 'collapsed') {
                if (sidebar) sidebar.classList.add('collapsed');
                if (mainWrapper) mainWrapper.classList.add('collapsed');
                document.documentElement.classList.add('sidebar-collapsed');
            }
        }

        // Apply state immediately when elements are available
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', applySidebarState);
        } else {
            applySidebarState();
        }

        // Re-enable transitions after initial load to prevent flash
        window.addEventListener('load', function() {
            setTimeout(function() {
                const sidebar = document.getElementById('sidebar');
                const mainWrapper = document.getElementById('mainWrapper');
                if (sidebar) sidebar.classList.add('transition-enabled');
                if (mainWrapper) mainWrapper.classList.add('transition-enabled');
            }, 100);
        });

        // Handle window resize
        window.addEventListener('resize', function () {
            const sidebar = document.getElementById('sidebar');
            const mainWrapper = document.getElementById('mainWrapper');
            const overlay = document.getElementById('sidebarOverlay');
            const savedState = localStorage.getItem('sidebarState');

            if (window.innerWidth > 768) {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
                // Apply collapsed state if needed
                if (savedState === 'collapsed') {
                    sidebar.classList.add('collapsed');
                    mainWrapper.classList.add('collapsed');
                    document.documentElement.classList.add('sidebar-collapsed');
                }
            } else {
                sidebar.classList.remove('collapsed');
                mainWrapper.classList.remove('collapsed');
                document.documentElement.classList.remove('sidebar-collapsed');
            }
        });

        // SweetAlert logout confirmation
        document.addEventListener('DOMContentLoaded', function () {
            const logoutLink = document.getElementById('logout-link');
            if (logoutLink) {
                logoutLink.addEventListener('click', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You will be logged out of your account.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Yes, logout'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('logout-form').submit();
                        }
                    });
                });
            }
        });

        // Auto-collapse sidebar on mobile when navigation link is clicked
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function () {
                if (window.innerWidth <= 768) {
                    const sidebar = document.getElementById('sidebar');
                    const overlay = document.getElementById('sidebarOverlay');
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                }
            });
        });
    </script>

</body>
</html>