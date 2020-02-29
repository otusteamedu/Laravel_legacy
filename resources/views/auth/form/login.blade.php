{{Form::open(['method'=>'POST'])}}
    <div class="form-group">
        {{ Form::label('email', __('messages.email')) }}
        {{ Form::email('email', null, ['class'=>'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('password', __('messages.password')) }}
        {{ Form::password('password', ['class'=>'form-control']) }}
    </div>
    {{Form::submit(__('messages.authentication'), ['class' => 'btn btn-success'])}}
{{Form::close()}}
