<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Добавление пользователя</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['url'=> route('users.store')]) }}
                    <div class="form-group">
                        {{ Form::label('name', 'Имя', null, ['class'=> 'col-form-label']) }}
                        {{ Form::text('name', null, ['class'=> 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('password', 'Пароль', null, ['class'=> 'col-form-label']) }}
                        {{ Form::password('password', ['class'=> 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('email', 'E-mail', null, ['class'=> 'col-form-label']) }}
                        {{ Form::email('email', null, ['class'=> 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('group_id', 'Группа', null, ['class'=> 'col-form-label']) }}
                        {{ Form::select('group_id', $groupList, null, ['class'=> 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('avatar', 'Аватар', null, ['class'=> 'col-form-label']) }}
                        {{ Form::text('avatar', null, ['class'=> 'form-control']) }}
                    </div>
                    <div class="modal-footer border-top-0 d-flex">
                        {{ Form::submit('Сохранить', ['class' => 'btn btn-primary', 'id' =>'modal-user-edit-submit']) }}
                        {{ Form::button('Закрыть', ['class' => 'btn btn-secondary', 'data-dismiss'=>'modal']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
