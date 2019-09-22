{{ Form::open(['route' => 'admin.widgets.store', 'class' => 'form-model']) }}
    <div class="form-row">
        <div class="col">
            {{ Form::label('company_id', __('admin.companies.model.single_name')) }}
            {{ Form::select('company_id', $companiesSelectList, null, ['class' => 'form-control' . ( $errors->has('company_id') ? ' is-invalid' : '' )]) }}
            @include('common.forms.error', ['field' => 'company_id'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::label('domain', __('Domain')) }}
            {{ Form::text('domain', null, ['class' => 'form-control' . ( $errors->has('domain') ? ' is-invalid' : '' )]) }}
            @include('common.forms.error', ['field' => 'domain'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::submit(__('Save'), ['class' => 'btn btn-success btn-lg btn-block']) }}
        </div>
    </div>
{{ Form::close() }}
