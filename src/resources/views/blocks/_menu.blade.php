<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">
        <a href="{{ route('home') }}" class="text-decoration-none text-dark">
            <img src="/images/icon.svg" width="30" height="30">
            ServiceTime
        </a>
    </h5>
    <ul class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="{{ route('home') }}">{{ __('buttons.menu.home') }}</a>
        @can('accessBusinessPanel')
            <a class="p-2 text-dark" href="{{ route('business.index') }}">{{ __('buttons.menu.business') }}</a>
{{--            <a class="p-2 text-dark" href="{{ route('staff.index') }}">{{ __('buttons.menu.staff') }}</a>--}}
            <a class="p-2 text-dark" href="{{ route('record.index') }}">{{ __('buttons.menu.records') }}</a>
            <a class="p-2 text-dark" href="{{ route('procedure.index') }}">{{ __('buttons.menu.procedures') }}</a>
            <a class="p-2 text-dark" href="{{ route('statistic.index') }}">{{ __('buttons.menu.statistic') }}</a>
        @endcan
    </ul>

    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-sm btn-outline-danger">
                        <i class="fa fa-sign-out-alt"></i> {{ __('buttons.menu.logout') }}
                    </button>
                </form>
            @endauth
        </div>
    @endif

    <button class="p-2 ml-3 dropdown-toggle text-dark btn btn-sm" data-toggle="dropdown">
        <i class="far fa-flag"></i>
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route("localize.set", ['locale' => 'ru']) }}">Ru</a>
        <a class="dropdown-item" href="{{ route("localize.set", ['locale' => 'en']) }}">En</a>
    </div>
</div>
