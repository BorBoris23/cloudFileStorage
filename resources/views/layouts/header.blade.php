<div class="header">
    <div class="headerContainer">
        <div class="projectName textColor">
           Cloud File Storage
        </div>
        <div class="logAndLogout">
            @if(isset($authUser->name))
            <div class="btn btn-sm btn-outline-secondary textColor">
                {{$authUser->name}}
            </div>
            <div class="btn btn-sm btn-outline-secondary textColor">
                @include('auth.logout')
            </div>
            @else
                @if($routeName !== 'login' && $routeName !== 'register')
                    <a class="btn btn-sm btn-outline-secondary textColor" href="/login">Log in</a>
                    <a class="btn btn-sm btn-outline-secondary textColor" href="/register">Sign up</a>
                @endif
            @endif
        </div>
    </div>
</div>



