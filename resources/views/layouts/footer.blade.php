<nav class="footer navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Cloud File Storage</a>
        <div class="d-flex" role="search">
            @if(isset($authUser->name))
                <div class="navbar-brand">
                    {{$authUser->name}}
                </div>
                @include('layouts.searchPanel')
                <div class="btn btn-dark">
                    @include('auth.logout')
                </div>
            @else
                @if($routeName !== 'login' && $routeName !== 'register')
                    <a class="btn btn-dark" href="/login">Log in</a>
                    <a class="btn btn-dark" href="/register">Sign up</a>
                @endif
            @endif
        </div>
    </div>
</nav>
