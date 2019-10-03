<div class="nav">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <ul>
        @if( auth()->check() )
            <li class="nav-item">
                <a class="nav-link" href="/ppv">PPV</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/svod">SVOD</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/subscription">Subscription</a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold" href="/user/{{ auth()->user()->id }}">{{ auth()->user()->name }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/logout">Log Out</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="/login">Log In</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/register">Register</a>
            </li>
        @endif
    </ul>
</div>
