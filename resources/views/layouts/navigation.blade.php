<ul class="nav flex-column pt-3 pt-md-0">
    <li class="nav-item">
        <a href="{{ route('users') }}" class="nav-link d-flex align-items-center">
            <span class="sidebar-icon me-3">
                <img src="{{ asset('images/brand/light.svg') }}" height="20" width="20" alt="Volt Logo">
            </span>
            <span class="mt-1 ms-1 sidebar-text">
                Admin Panel
            </span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('users') ? 'active' : '' }}">
        <a href="{{ route('users') }}" class="nav-link">
            <span class="sidebar-icon">
                <i class="fas fa-users"></i>
            </span>
            <span class="sidebar-text">{{ __('Users') }}</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('plans') ? 'active' : '' }}">
        <a href="{{ route('plans') }}" class="nav-link">
            <span class="sidebar-icon">
                <i class="fas fa-users"></i>
            </span>
            <span class="sidebar-text">{{ __('Plans') }}</span>
        </a>
    </li>

    <li class="nav-item ">
        <span class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#submenu-app">
            <span>
                <span class="sidebar-icon me-3">
                    <i class="fas fa-vr-cardboard fa-fw"></i>
                </span>
                <span class="sidebar-text">Programs</span>
            </span>
            <span class="link-arrow">
                <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd">
                    </path>
                </svg>
            </span>
        </span>
        <div class="multi-level collapse" role="list" id="submenu-app" aria-expanded="false">
            <ul class="flex-column nav">
                <li class="nav-item {{ request()->routeIs('add-program') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('add-program') }}">
                        <span class="sidebar-icon">
                            <i class="fas fa-circle"></i>
                        </span>
                        <span class="sidebar-text">Add Program</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('show-programs') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('show-programs') }}">
                        <span class="sidebar-icon">
                            <i class="fas fa-circle"></i>
                        </span>
                        <span class="sidebar-text">All Programs</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item ">
        <span class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#submenu-app2">
            <span>
                <span class="sidebar-icon me-3">
                    <i class="fas fa-vr-cardboard fa-fw"></i>
                </span>
                <span class="sidebar-text">Posts</span>
            </span>
            <span class="link-arrow">
                <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd">
                    </path>
                </svg>
            </span>
        </span>
        <div class="multi-level collapse" role="list" id="submenu-app2" aria-expanded="false">
            <ul class="flex-column nav">
                <li class="nav-item {{ request()->routeIs('add-post') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('add-post') }}">
                        <span class="sidebar-icon">
                            <i class="fas fa-circle"></i>
                        </span>
                        <span class="sidebar-text">Add Post</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('posts') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('show-posts') }}">
                        <span class="sidebar-icon">
                            <i class="fas fa-circle"></i>
                        </span>
                        <span class="sidebar-text">All Posts</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item {{ request()->routeIs('settings') ? 'active' : '' }}">
        <a href="{{ route('settings') }}" class="nav-link">
            <span class="sidebar-icon">
                <i class="fas fa-cogs"></i>
            </span>
            <span class="sidebar-text">{{ __('Settings') }}</span>
        </a>
    </li>
</ul>