<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/">{{ env('APP_NAME') }} {{ isset($title) ? "- $title" : '' }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link @if (request()->is('/')) active @endif" aria-current="page"
                        href="/">
                        <i class="fa fa-home mr-2"></i>
                        Home
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link @if (request()->is('users')) active @endif" aria-current="page"
                            href="/users">
                            <i class="fa fa-users mr-2"></i>
                            Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->is('upacara')) active @endif" aria-current="page"
                            href="/upacara">
                            <i class="fa fa-users mr-2"></i>
                            Upacara
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->is('urunan')) active @endif" aria-current="page"
                            href="/urunan">
                            <i class="fa fa-users mr-2"></i>
                            Urunan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->is('login')) active @endif" aria-current="page"
                            href="/logout">
                            <i class="fa fa-sign-out mr-2"></i>
                            Logout
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link @if (request()->is('login')) active @endif" aria-current="page"
                            href="/login">
                            <i class="fa fa-sign-in mr-2"></i>
                            Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
