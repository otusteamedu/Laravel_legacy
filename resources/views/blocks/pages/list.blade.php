<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        @include($tableContent, [
                            'content' => $content
                        ])
                    </table>
                </div>
            </div>
            @php/** @var Illuminate\Pagination\LengthAwarePaginator $content['items'] */@endphp
            {{ $content['items']->links() }}
        </div>
    </div>
</div>
<hr>
<a href="{{ route($addRoute) }}" type="button" class="btn btn-primary">@lang('buttons.add')</a>
<hr>
