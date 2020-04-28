<ul class="admin_list">

    <li class="text-field">
        <div class="form-group">
            {{ Form::label('name', trans('users.name')) }}
            {{ Form::text('name', null, array('class'=>'form-control')) }}
        </div>
    </li>
    <li class="text-field">
        <div class="form-group">
            {{ Form::label('email', trans('users.email')) }}
            {{ Form::text('email', null, array('class'=>'form-control')) }}
        </div>
    </li>
    <li class="text-field">
        <div class="form-group">
            {{ Form::label('password', trans('users.password')) }}
            {{ Form::password('password', null, array('class'=>'form-control')) }}
        </div>
    </li>
    <li class="text-field">
        <div class="form-group">
            {{ Form::label('password_confirmation', trans('users.password_confirm')) }}
            {{ Form::password('password_confirmation', null, array('class'=>'form-control')) }}

        </div>
    </li>
    <li class="text-field">
        {{ Form::label('role_id', trans('users.role')) }}
        <div class="input-prepend">

            {!! Form::select('role_id', $roles, (isset($user)) ? $user->roles()->first()->id : null) !!}
        </div>

    </li>


</ul>