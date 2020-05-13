<div class="card">
    <div class="card-body">
        <div class="h5">{{ $user->name }}</div>
        <div class="h7 text-muted">@lang('app.full_name') : {{ $user->fullName }}</div>
        <div class="h7">{{ $user->description }}</div>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <div class="h6 text-muted">@lang('app.friends')</div>
            <div class="h5">{{ $user->friendsCount }}</div>
        </li>
    </ul>
</div>
