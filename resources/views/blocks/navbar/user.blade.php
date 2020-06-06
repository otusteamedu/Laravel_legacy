<a href="{{ route('staffs.show', ['staff' => Auth::user()->id]) }}" data-toggle="tooltip" title="{{ __('blocks/navbar.user.profile') }}">
    @materialicon('action', 'account_box')
</a>
