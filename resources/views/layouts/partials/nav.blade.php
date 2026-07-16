<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>

        <!-- Collapsed Hamburger -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#app-navbar-collapse" aria-controls="app-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.search') }}">{{ __('app.search_your_family') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('birthdays.index') }}">{{ __('birthday.birthday') }}</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                <?php $mark = (preg_match('/\?/', url()->current())) ? '&' : '?';?>
                <li class="nav-item"><a class="nav-link" href="{{ url(url()->current() . $mark . 'lang=en') }}">en</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url(url()->current() . $mark . 'lang=id') }}">id</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url(url()->current() . $mark . 'lang=ms') }}">ms</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url(url()->current() . $mark . 'lang=ur') }}">ur</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url(url()->current() . $mark . 'lang=ar') }}">ar</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url(url()->current() . $mark . 'lang=fa') }}">fa</a></li>
                
                @if (Auth::guest())
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @if (is_system_admin(auth()->user()))
                                <li><a class="dropdown-item" href="{{ route('backups.index') }}">{{ __('backup.list') }}</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('profile') }}">{{ __('app.my_profile') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('password_change') }}">{{ __('auth.change_password') }}</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>