<div class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="collapse navbar-collapse navbar-nav mr-auto" id="navbarSupportedContent">
        <div class="navbar-nav mr-auto">
            <a class="navbar-brand" href="/">Cloud File Storage</a>
        </div>
        @if(isset($authUser->name))
            @include('layouts.searchPanel')
            <div class="btn btn-dark">
                {{$authUser->name}}
            </div>
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



