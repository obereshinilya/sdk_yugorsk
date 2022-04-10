<div class="header_inside">
    <div class="user_profile">
        <img alt="Пользователь" src="{{ asset('assets/images/user.jpg') }}" class="user_avatar">
        <div class="user_info">
           @guest
               <p></p>
                <p class="white_text user_name">
                    <a class="logout" href="{{ route('login') }}">{{ __('Login') }}</a>
                </p>

            @else
               <a class="logout" href="{{ route('changepwd') }}">
                <p class="white_text user_name">{{ Auth::user()->name }}</p>
               </a>
                <a class="logout" href="{{ route('logout') }}">
                    {{ __('Logout') }}
                </a>
            @endguest
        </div>
    </div>
    <div class="time_block">
        <p>{{Carbon\Carbon::now()}}</p>
    </div>
</div>
