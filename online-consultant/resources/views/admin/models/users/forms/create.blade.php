{{ Form::open(['route' => 'admin.users.store', 'class' => 'form-model']) }}
    <div class="form-row">
        <div class="col">
            {{ Form::label('company_id', __('admin.companies.model.single_name')) }}
            {{ Form::select('company_id', $companiesSelectList, null, ['class' => 'form-control' . ( $errors->has('company_id') ? ' is-invalid' : '' )]) }}
            @include('common.forms.error', ['field' => 'company_id'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::label('name', __('Name')) }}
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
            {{ Form::submit(__('Save'), ['class' => 'btn btn-success btn-lg btn-block']) }}
        </div>
    </div>
{{ Form::close() }}
