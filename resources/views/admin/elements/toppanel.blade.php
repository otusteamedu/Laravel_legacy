<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    @isset($title)
        <h1 class="h2">{{ $title }}</h1>
    @endif
    @isset($cmdButtons)
        @if(count($cmdButtons) > 0)
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('admin.actions')
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop">
                    @foreach($cmdButtons as $item)
                            <a class="dropdown-item" href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                    @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endisset
</div>
