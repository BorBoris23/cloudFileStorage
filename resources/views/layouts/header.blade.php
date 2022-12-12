<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Cloud File Storage</a>
        <div class="rightContainer">
            @if(isset($authUser->name))
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{$authUser->name}}</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item">@include('auth.logout')</a>
                        </ul>
                    </li>
                </ul>
                @include('layouts.searchPanel')
            @else
                @if($routeName !== 'login' && $routeName !== 'register')
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active nav-item" href="/login">Log in</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active nav-item" href="/register">Sign up</a>
                        </li>
                    </ul>
                @endif
            @endif
        </div>
    </div>
</nav>
