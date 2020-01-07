@if($isLoggedIn)
    <a class="nav-link p-2 d-inline-block" href="{{ route('public.account.index') }}" aria-label="@lang('public.login')">
        <i class="fas fa-user-edit fa-1x"></i>
        {{ $loggedUser['name'] }}
    </a>
    {{ Form::open(['url' => route('logout'), 'method' => 'post', 'class' => 'd-inline', 'id' => 'logoutForm', 'name' => 'logoutForm']) }}
        <a class="nav-link p-2 d-inline-block" href="#" onclick="if(confirm('Вы уверены?')) document.forms['logoutForm'].submit();return false;">
            <i class="fas fa-sign-out-alt fa-1x"></i>
        </a>
    {{ Form::close() }}
@else
    <a class="nav-link p-2" href="{{ route('login') }}" aria-label="@lang('public.login')">
        <i class="fas fa-sign-in-alt fa-1x"></i>
        <span class="d-none d-lg-inline">@lang('public.login')</span>
    </a>
@endif
