<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Добавление категории</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['url'=> route('categories.store'), 'id' => 'modal-add-form']) }}
                    <div id="flash-message" class="flash-message alert alert-danger" style="display: none;"></div>
                    <div class="form-group">
                        {{ Form::label('title', 'Название', ['class'=> 'col-form-label']) }}
                        {{ Form::text('title', null, ['class'=> 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('name', 'Алиас', ['class'=> 'col-form-label']) }}
                        {{ Form::text('name', null, ['class'=> 'form-control']) }}
                    </div>
                    <div class="modal-footer border-top-0 d-flex">
                        {{ Form::submit('Сохранить', ['class' => 'btn btn-primary']) }}
                        {{ Form::button('Закрыть', ['class' => 'btn btn-secondary', 'data-dismiss'=>'modal']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
