@include('cms.blocks.form.messages')
{{ Form::model($user, ['url' => route('cms.users.update', ['user' => $user]), 'method' => 'PUT', 'files' => true]) }}
    @include('cms.users.blocks.form.fields')
    <div class="form-group">
        {{ Form::submit(__('messages.edit'), array('class' => 'btn btn-success')) }}
    </div>
{{ Form::close() }}