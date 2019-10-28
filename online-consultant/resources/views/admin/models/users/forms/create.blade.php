{{ Form::open(['route' => 'admin.users.store', 'class' => 'form-model', 'autocomplete' => 'off']) }}
    @if(count($companiesSelectList) > 0)
        <div class="form-row">
            <div class="col">
                {{ Form::label('company_id', __('admin.companies.model.single_name')) }}
                {{ Form::select('company_id', $companiesSelectList, null, [
                    'class' => 'form-control' . ( $errors->has('company_id') ? ' is-invalid' : '' ),
                    'required' => ''
                ]) }}
                @include('common.forms.errors.validation', ['field' => 'company_id'])
            </div>
        </div>
    @endif
    <div class="form-row">
        <div class="col">
            {{ Form::label('name', __('common.form_fields.name.label')) }}
            {{ Form::text('name', null, [
                'class' => 'form-control' . ( $errors->has('name') ? ' is-invalid' : '' ),
                'required' => ''
            ]) }}
            @include('common.forms.errors.validation', ['field' => 'name'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::label('email', __('common.form_fields.email.label')) }}
            {{ Form::email('email', null, [
                'class' => 'form-control' . ( $errors->has('email') ? ' is-invalid' : '' ),
                'required' => ''
            ]) }}
            @include('common.forms.errors.validation', ['field' => 'email'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::label('roles[]', __('admin.roles.model.plural_name')) }}
            {{ Form::select('roles[]', $allRolesSelectList, null, [
                'class' => 'form-control select2' . ($errors->has('roles') ? ' is-invalid' : ''),
                'multiple' => 'multiple',
                'required' => ''
            ]) }}
            @include('common.forms.errors.validation', ['field' => 'roles'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::label('password', __('common.form_fields.password.label')) }}
            {{ Form::password('password', [
                'class' => 'form-control' . ( $errors->has('password') ? ' is-invalid' : '' ),
                'required' => ''
            ]) }}
            @include('common.forms.errors.validation', ['field' => 'password'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::label('password_confirmation', __('common.form_fields.password_confirmation.label')) }}
            {{ Form::password('password_confirmation', [
                'class' => 'form-control' . ( $errors->has('password_confirmation') ? ' is-invalid' : '' ),
                'required' => '',
                'autocomplete' => 'new-password'
            ]) }}
            @include('common.forms.errors.validation', ['field' => 'password_confirmation'])
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            {{ Form::submit(__('admin.models.controls.save'), [
                'class' => 'btn btn-success btn-lg btn-block'
            ]) }}
        </div>
    </div>
{{ Form::close() }}
