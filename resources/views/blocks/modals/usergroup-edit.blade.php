<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Редактирование группы</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['url'=> route('usergroups.store')]) }}
                    <div class="form-group">
                        {{ Form::hidden('id', null, ['class'=> 'form-control', 'id' => 'modalField-id']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('title', 'Название', null, ['class'=> 'col-form-label']) }}
                        {{ Form::text('title', null, ['class'=> 'form-control', 'id' => 'modalField-title']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('name', 'Алиас', null, ['class'=> 'col-form-label']) }}
                        {{ Form::text('name', null, ['class'=> 'form-control', 'id' => 'modalField-name']) }}
                    </div>
                    <div class="modal-footer border-top-0 d-flex">
                        {{ Form::submit('Сохранить', ['class' => 'btn btn-primary', 'id' =>'modal-submit']) }}
                        {{ Form::button('Закрыть', ['class' => 'btn btn-secondary', 'data-dismiss'=>'modal']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
