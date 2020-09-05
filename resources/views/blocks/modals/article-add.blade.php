<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('messages.admin.article-add.title')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['url'=> route('articles.store'), 'id' => 'modal-add-form']) }}
                    <div id="flash-message" class="flash-message alert alert-danger" style="display: none;"></div>
                    <div class="form-group">
                        {{ Form::label('title', trans('messages.admin.article.title'), ['class'=> 'col-form-label']) }}
                        {{ Form::text('title', null, ['class'=> 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('category_id', trans('messages.admin.article.category'), ['class'=> 'col-form-label']) }}
                        {{ Form::select('category_id', $categoriesList, null, ['placeholder' => 'Не выбрано', 'class'=> 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('intro_text', trans('messages.admin.article.intro_text'), ['class'=> 'col-form-label']) }}
                        {{ Form::textarea('intro_text', null, ['class'=> 'form-control', 'rows' => 3]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('full_text', trans('messages.admin.article.full_text'), ['class'=> 'col-form-label']) }}
                        {{ Form::textarea('full_text', null, ['class'=> 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::input('checkbox','is_pending', null) }}
                        {{ Form::label('is_pending', trans('messages.admin.article.is_pending'), ['class'=> 'col-form-label']) }}
                    </div>
                    <div class="modal-footer border-top-0 d-flex">
                        {{ Form::submit(trans('messages.save'), ['class' => 'btn btn-primary']) }}
                        {{ Form::button(trans('messages.close'), ['class' => 'btn btn-secondary', 'data-dismiss'=>'modal']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
