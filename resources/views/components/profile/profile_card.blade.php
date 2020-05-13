<div class="card">
    <div class="view overlay">
        <img class="card-img-top" src="{{ $user->avatarLink }}"
             alt="{{ $user->fullName }}">
    </div>
    <div class="card-body">
        <h4 class="card-title">{{ $user->name }}</h4>
        <p class="card-text">{{ $user->description }}</p>
        <button type="button" class="btn btn-outline-primary">@lang('app.friendship_button')</button>
        <button type="button" class="btn btn-danger">@lang('app.report_button')</button>
    </div>
</div>
