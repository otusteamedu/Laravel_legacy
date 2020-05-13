<div class="d-flex justify-content-between align-items-center">
    <div class="d-flex justify-content-between align-items-center">
        <div class="mr-2">
            <img class="rounded-circle" width="45" src="{{ $author->avatarLinkSmall }}" alt="">
        </div>
        <div class="ml-2">
            <div class="h5 m-0">{{ $author->name }}</div>
            <div class="h7 text-muted">{{ $author->fullName }}</div>
        </div>
    </div>
    <div>
        <div class="dropdown">
            <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg class="bi bi-list" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 013 11h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 7h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 3h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
                </svg>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                <a class="dropdown-item" href="#">@lang('app.post.menu.save')</a>
                <a class="dropdown-item" href="#">@lang('app.post.menu.hide')</a>
                <a class="dropdown-item" href="#">@lang('app.post.menu.report')</a>
            </div>
        </div>
    </div>
</div>
