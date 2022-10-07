<form method="POST" action="{{ route('logout') }}">
    @csrf

    <logOut :href="route('logout')"
                     onclick="event.preventDefault();
                    this.closest('form').submit();">
        {{ __('Logout') }}
    </logOut>
</form>

