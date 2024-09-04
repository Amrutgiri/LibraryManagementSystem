<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('Admin/vendors/images/deskapp-logo.png') }}" alt="" class="dark-logo" />
            {{-- <img src="{{ asset('Admin/vendors/images/deskapp-logo-white.svg') }}" alt="" class="light-logo" /> --}}
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li class="dropdown {{ Route::is('admin.dashboard') ? 'show' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-house"></span>Home
                    </a>

                </li>
                <li class="dropdown {{ Route::is('admin.users') ? 'show' : '' }}">
                    <a href="{{ route('admin.users') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-people"></span><span class="mtext">Users</span>
                    </a>

                </li>
                <li class="dropdown {{ Route::is('admin.rack.manage') ? 'show' : '' }}">
                    <a href="{{ route('admin.rack.manage') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-columns"></span><span class="mtext">Rack Manage</span>
                    </a>
                </li>

                <li class="dropdown {{ Route::is('admin.genre.manage') ? 'show' : '' }}">
                    <a href="{{ route('admin.genre.manage') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-list-nested"></span><span class="mtext">Book Type</span>
                    </a>
                </li>

                <li class="dropdown {{ Route::is('admin.book.manage') ? 'show' : '' }}">
                    <a href="{{ route('admin.book.manage') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-book"></span><span class="mtext">Book Manage</span>
                    </a>
                </li>

                <li class="dropdown {{ Route::is('admin.book.limit') ? 'show' : '' }}">
                    <a href="{{ route('admin.book.limit') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-ui-radios"></span><span class="mtext">Book Limit</span>
                    </a>
                </li>

                <li class="dropdown {{ Route::is('admin.settings') ? 'show' : '' }}">
                    <a href="{{ route('admin.settings') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-gear-fill"></span><span class="mtext">Settings</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>
