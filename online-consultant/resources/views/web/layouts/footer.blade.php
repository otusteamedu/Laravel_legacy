<div class="page-footer">
    <div class="container">
        <div class="row mb-2">
            <div class="col">
                <ul class="list-inline m-0">
                    <li class="list-inline-item">
                        <a href="{{ route('web.home') }}">{{ __('common.pages.home') }}</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ route('web.contact') }}">{{ __('common.pages.contact') }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col">
                {{ date('Y') }}
            </div>
        </div>
    </div>
</div>
