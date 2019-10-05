@include('cms.blocks.form.errors')
{{ Form::open(['url' => route('cms.users.store')]) }}
    @include('cms.users.blocks.form.fields')
    <div class="form-group">
        {{ Form::submit(__('messages.addUser'), array('class' => 'btn btn-success')) }}
    </div>
{{ Form::close() }}