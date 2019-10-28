{{ Form::open(['route' => 'admin.conversations.store', 'class' => 'form-model']) }}
    <div class="form-row">
        <div class="col">
            {{ Form::label('company_id', __('admin.companies.model.single_name')) }}
            {{ Form::select('company_id', $companiesSelectList, null, ['class' => 'form-control' . ( $errors->has('company_id') ? ' is-invalid' : '' )]) }}
            @include('common.forms.errors.validation', ['field' => 'company_id'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::label('widget_id', __('admin.widgets.model.single_name')) }}
            {{ Form::select('widget_id', $widgetsSelectList, null, ['class' => 'form-control' . ( $errors->has('widget_id') ? ' is-invalid' : '' )]) }}
            @include('common.forms.errors.validation', ['field' => 'widget_id'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::label('manager_id', __('admin.users.model.single_name')) }}
            {{ Form::select('manager_id', $usersSelectList, null, ['class' => 'form-control' . ( $errors->has('manager_id') ? ' is-invalid' : '' )]) }}
            @include('common.forms.errors.validation', ['field' => 'manager_id'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::label('lead_id', __('admin.leads.model.single_name')) }}
            {{ Form::select('lead_id', $leadsSelectList, null, ['class' => 'form-control' . ( $errors->has('lead_id') ? ' is-invalid' : '' )]) }}
            @include('common.forms.errors.validation', ['field' => 'lead_id'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::label('text', __('Text')) }}
            {{ Form::textarea('text', null, ['class' => 'form-control' . ( $errors->has('text') ? ' is-invalid' : '' )]) }}
            @include('common.forms.errors.validation', ['field' => 'text'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::submit(__('admin.models.controls.save'), ['class' => 'btn btn-success btn-lg btn-block']) }}
        </div>
    </div>
{{ Form::close() }}
