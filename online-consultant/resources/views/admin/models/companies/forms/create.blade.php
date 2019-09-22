{{ Form::open(['route' => 'admin.companies.store', 'class' => 'form-model']) }}
    <div class="form-row">
        <div class="col">
            {{ Form::label('name', __('admin.companies.fields.name')) }}
            {{ Form::text('name', null, ['class' => 'form-control' . ( $errors->has('name') ? ' is-invalid' : '' )]) }}
            @include('common.forms.error', ['field' => 'name'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::label('email', __('E-Mail')) }}
            {{ Form::email('email', null, ['class' => 'form-control' . ( $errors->has('email') ? ' is-invalid' : '' )]) }}
            @include('common.forms.error', ['field' => 'email'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::label('url', __('Url')) }}
            {{ Form::text('url', null, ['class' => 'form-control' . ( $errors->has('url') ? ' is-invalid' : '' )]) }}
            @include('common.forms.error', ['field' => 'url'])
        </div>
    </div>
    @foreach($addressFields as $fieldName => $fieldLabel)
        <div class="form-row">
            <div class="col">
                {{ Form::label("address[$fieldName]", $fieldLabel) }}
                {{ Form::text("address[$fieldName]", null, ['class' => 'form-control' . ( $errors->has("address.$fieldName") ? ' is-invalid' : '' )]) }}
                @include('common.forms.error', ['field' => "address.$fieldName"])
            </div>
        </div>
    @endforeach
    <div class="form-row">
        <div class="col">
            {{ Form::submit(__('Save'), ['class' => 'btn btn-success btn-lg btn-block']) }}
        </div>
    </div>
{{ Form::close() }}
