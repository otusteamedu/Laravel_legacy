<div>
    @if ($isClient)
        <a href="{{ route('clients.show', ['client' => $user['id']]) }}" data-toggle="tooltip" title="{{ __('blocks/navbar.user.profile') }}">
            @materialicon('action', 'account_box')
        </a>
    @else
        <a class="btn btn-link" href="{{ route('staffs.show', ['staff' => $user['id']]) }}" data-toggle="tooltip" title="{{ __('blocks/navbar.user.profile') }}">
            @materialicon('action', 'account_box')
        </a>
    @endif
    <form method="POST" action="{{ route('logout') }}" class="d-inline">
        @csrf
        <button class="btn btn-link" type="submit" data-toggle="tooltip" title="{{ __('blocks/navbar.user.logout') }}">@materialicon('action', 'exit_to_app')</button>
    </form>
</div>
